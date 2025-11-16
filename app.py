from flask import Flask, request, jsonify
import serial, threading, subprocess, sqlite3, time

app = Flask(__name__)
ser = serial.Serial('/dev/ttyUSB0', 2400, timeout=0.5)  # open once

lock = threading.Lock()

def read_exact(n):
    buf = b''
    deadline = time.time() + 2
    while len(buf) < n and time.time() < deadline:
        chunk = ser.read(n - len(buf))
        if chunk:
            buf += chunk
    return buf

@app.route('/start-recording', methods=['POST'])
def start_recording():
    # start raspivid detached; use full path
    subprocess.Popen(['/usr/bin/raspivid','-o','/var/www/html/live.h264','-t','0'])
    return jsonify({'status':'ok'})

@app.route('/stop-recording', methods=['POST'])
def stop_recording():
    subprocess.run(['pkill','-f','raspivid'])
    return jsonify({'status':'ok'})

@app.route('/read-uid', methods=['POST'])
def read_uid():
    with lock:
        # expect the controller to send an 'R' before the UID; caller can omit this
        # or you can design to only read UID bytes directly
        # Read 8 bytes UID
        data = read_exact(8)
    if not data or len(data) != 8:
        return jsonify({'status':'error','msg':'timeout or incomplete UID'}), 400
    uid = data.decode(errors='ignore')
    # lookup in DB (example sqlite)
    conn = sqlite3.connect('/path/to/your.db')
    cur = conn.cursor()
    cur.execute("SELECT pin FROM users WHERE uid = ?", (uid,))
    row = cur.fetchone()
    conn.close()
    if row:
        return jsonify({'status':'ok','pin': row[0]})
    else:
        return jsonify({'status':'not_found'}), 404

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)