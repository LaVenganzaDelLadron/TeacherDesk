
async function loadStudents() {
    const studentGrid = document.getElementById("studentGrid");
    const searchInput = document.getElementById("searchInput");
    const searchBtn = document.getElementById("searchBtn");

    async function fetchStudents(query = "") {
        const res = await fetch('backend/student_list_controller.php?action=students');
        let data = await res.json();
        if (query) {
            data = data.filter(student => student.first_name.toLowerCase().includes(query.toLowerCase()))
        }
    
        studentGrid.innerHTML = "";
        if (data.length === 0) {
            studentGrid.innerHTML = "<p class='p-4'>No students found.</p>";
            return;
        }
        data.forEach(student => {
            const studentCard = document.createElement("div");
            studentCard.className = "bg-white p-4 rounded shadow";
            studentCard.innerHTML = `
                <h3 class="text-lg font-semibold">${student.name}</h3>
                <p class="text-gray-600">Email: ${student.course}</p>
                <p class="text-gray-600">Enrolled: ${student.year}</p>
            `;
            studentGrid.appendChild(studentCard);
        });
    }
    fetchStudents();
        if(searchBtn){
        searchBtn.addEventListener('click', ()=> fetchStudents(searchInput.value.trim()));
        searchInput.addEventListener('keypress', e=>{
            if(e.key==='Enter') fetchStudents(searchInput.value.trim());
        });
    }

}
