<script>
function checkSecurityAlert() {
    fetch("get_alert.php")
        .then(response => response.text())
        .then(data => {
            if (data) {
                showPopup(data);
            }
        });
}

function showPopup(message) {
    let popup = document.createElement("div");
    popup.innerHTML = `<div style='position: fixed; top: 20%; left: 50%; transform: translate(-50%, -50%);
                        background: red; color: white; padding: 20px; border-radius: 10px; font-size: 18px;
                        box-shadow: 0px 0px 10px black; text-align: center;'>
                        <strong>${message}</strong></div>`;

    document.body.appendChild(popup);
    setTimeout(() => { popup.remove(); }, 5000);
}

setInterval(checkSecurityAlert, 3000);
</script>
