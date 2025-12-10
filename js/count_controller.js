function loadCount(){
    fetch("backend/count_controller.php")
        .then(response => response.json())
        .then(data => {
            document.getElementById("totalStudents").innerHTML = data.totalStudent;
            document.getElementById("onlineStudents").innerHTML = data.totalOnline;
        })
        .catch(error => console.log(error));
}

loadCount();
