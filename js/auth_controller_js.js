
document.getElementById("signupForm").addEventListener("submit", async function(e){
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("signup", "1");

    let response = await fetch("backend/auth_controller.php", { method: "POST", body: formData });
    let data = await response.json();
    showMessage(data.message);

    if(data.status === "success" && data.redirect){
        setTimeout(() => { window.location.href = data.redirect; }, 2000);
    }
});


document.getElementById("loginForm").addEventListener("submit", async function(e){
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("login", "1");

    let response = await fetch("backend/auth_controller.php", { method: "POST", body: formData });
    let data = await response.json();
    showMessage(data.message);

    if(data.status === "success" && data.redirect){
        setTimeout(() => { window.location.href = data.redirect; }, 2000);
    }
});

function showMessage(msg){
    let div = document.createElement("div");
    div.className = "popup-card";
    div.innerText = msg;
    document.body.appendChild(div);

    setTimeout(()=>{ div.remove(); }, 2000);
}
