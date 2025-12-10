
    document.addEventListener("DOMContentLoaded", () => {
        const studentGrid = document.getElementById("studentGrid");
        const searchInput = document.getElementById("searchInput");
        const searchBtn = document.getElementById("searchBtn");

        function loadStudents(query = "") {
            fetch("backend/student_list_controller.php")
                .then(res => res.json())
                .then(data => {
                    if(query){
                        data = data.filter(s => s.name.toLowerCase().includes(query.toLowerCase()));
                    }

                    studentGrid.innerHTML = "";
                    if(data.length === 0){
                        studentGrid.innerHTML = "<p>No students found</p>";
                        return;
                    }

                    data.forEach(student => {
                        const card = document.createElement("div");
                        card.className = "bg-white rounded-2xl shadow-lg p-4 relative flex flex-col justify-between";

                        card.innerHTML = `
                            <div class="mb-2">
                                <h3 class="text-lg font-semibold">${student.name}</h3>
                                <p class="text-gray-500 text-sm">${student.course}</p>
                                <p class="text-gray-500 text-sm">Year ${student.year}</p>
                            </div>
                            <span class="absolute top-2 right-2 text-xs font-semibold px-2 py-1 rounded-full ${student.status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white'}">
                                ${student.status.toUpperCase()}
                            </span>
                        `;

                        studentGrid.appendChild(card);
                    });
                })
                .catch(err => console.error(err));
        }

        // Initial load
        loadStudents();

        // Search
        searchBtn.addEventListener("click", () => {
            const query = searchInput.value.trim();
            loadStudents(query);
        });

        searchInput.addEventListener("keypress", e => {
            if(e.key === "Enter") {
                e.preventDefault();
                searchBtn.click();
            }
        });
    });
