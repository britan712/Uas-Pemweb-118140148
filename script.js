const apiUrl = "http://localhost/uas_britan/server/";

// Token Configuraton
function saveTokenToLocalStorage(token) {
    localStorage.setItem('token', token);
}

function getTokenFromLocalStorage() {
    return localStorage.getItem('token');
}

const storedToken = getTokenFromLocalStorage();

function submitForm() {
    const userAgent = navigator.userAgent;

    fetch('https://api64.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            const userIP = data.ip;

            const formData = new FormData(document.getElementById("educationForm"));
            formData.append("userAgent", userAgent);
            formData.append("userIP", userIP);

            const name = document.getElementById("name").value;
            const subject = document.getElementById("subject").value;

            if (name === "" || subject === "") {
                alert("Nama dan Mata Pelajaran harus diisi!");
                return;
            }

            console.log(formData)

            fetch(apiUrl + '/save_data.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(message => {
                    console.log(message);
                    alert("Berhasil Menambahkan Data.");
                    displayData();
                })
                .catch(error => {
                    alert("Terjadi Kesalahan, Silakan Coba Kembali.");
                    console.error('Error inserting data:', error);
                });
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
        });
}

function displayData() {
    fetch(apiUrl + 'save_data.php')
        .then(response => response.json())
        .then(dataFromServer => {
            displayDataFromServer(dataFromServer);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function displayDataFromServer(dataFromServer) {
    const tableBody = document.querySelector("#dataTable tbody");
    tableBody.innerHTML = "";

    dataFromServer.forEach(item => {
        const row = tableBody.insertRow();
        row.insertCell(0).textContent = item.name;
        row.insertCell(1).textContent = item.subject;
        row.insertCell(2).textContent = item.attendance == 1 ? "Hadir" : "Tidak Hadir";
        row.insertCell(3).textContent = item.grade;
        row.insertCell(4).textContent = item.user_agent;
        row.insertCell(5).textContent = item.user_ip;

        // Tambahkan tombol update di kolom terakhir
        const updateButton = document.createElement("button");
        updateButton.textContent = "Update";
        updateButton.addEventListener("click", function () {
            window.location.href = `pages/update.html?id=${item.id}`;
        });

        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", function () {
            deleteData(item.id);
        });

        const cellUpdate = row.insertCell(6);
        const cellDelete = row.insertCell(7);
        cellUpdate.appendChild(updateButton);
        cellDelete.appendChild(deleteButton);
    });
}

function deleteData(id) {
    const confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
    if (confirmDelete) {
        const formData = new FormData();
        formData.append("id", id);

        fetch(apiUrl + 'delete.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(message => {
                console.log(message);
                displayData();
            })
            .catch(error => {
                console.error('Error deleting data:', error);
            });
    }
}

function logout() {
    fetch(apiUrl + 'Authentication/logout.php', {
        method: 'POST',
        body: new FormData(),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.removeItem('token');
                console.log('Logout successful.');
                window.location.reload();
            } else {
                console.error('Logout failed:', data.message);
            }
        })
        .catch(error => {
            console.error('Error during logout:', error);
        });
}


displayData();
