document.getElementById("registerForm").addEventListener("submit", async function(e){
    e.preventDefault();
    let formData = new FormData(this);

    try {
        let response = await fetch("backend/student_controller.php", { 
            method: "POST", 
            body: formData 
        });
        let data = await response.json();

        // Use type for styling
        showMessage(data.message, data.status);

        if(data.status === "success" && data.redirect){
            setTimeout(() => { window.location.href = data.redirect; }, 2000);
        }

    } catch(err) {
        showMessage("Network error!", "error");
    }
});



function showMessage(msg, type = "success") {
    let div = document.createElement("div");
    div.className = `popup-card ${type}`;
    
    // Optional: add an icon
    const icon = document.createElement("span");
    icon.innerHTML = type === "success" ? "✔️" : "❌";
    div.appendChild(icon);

    const text = document.createElement("span");
    text.innerText = msg;
    div.appendChild(text);

    document.body.appendChild(div);

    // Remove with slide out
    setTimeout(() => {
        div.style.animation = "slideOut 0.4s forwards";
        setTimeout(() => { div.remove(); }, 400);
    }, 2500); // visible for 2.5s
}
