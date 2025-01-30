let branches = [];
let currentId = 1;

// Dark mode toggle functionality
const darkModeToggle = document.getElementById("darkModeToggle");

darkModeToggle.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
    if (document.body.classList.contains("dark-mode")) {
        darkModeToggle.innerHTML = '<i class="mode-icon">☀️</i>';
    } else {
        darkModeToggle.innerHTML = '<i class="mode-icon">🌙</i>';
    }
});

// Add a branch
function addBranch() {
    const name = document.getElementById("branchName").value;
    const email = document.getElementById("branchEmail").value;
    const status = document.getElementById("branchStatus").value;
    const date = document.getElementById("branchDate").value;

    // Check if all fields are filled
    if (!name || !email || !status || !date) {
        alert("Please fill in all fields.");
        return;
    }

    const branch = {
        id: currentId++,
        name: name,
        email: email,
        status: status,
        date: new Date(date).toLocaleDateString(), // Convert the date input to a readable string format
    };

    branches.push(branch);
    updateTable();
    document.getElementById("addForm").reset();
    bootstrap.Modal.getInstance(document.getElementById("addModal")).hide();
}

// Edit a branch directly in the table
function enableEdit(row, branchId) {
    const cells = row.querySelectorAll("td");
    const nameCell = cells[1];
    const emailCell = cells[2];
    const statusCell = cells[3];

    // Turn the cells into editable inputs
    nameCell.innerHTML = `<input type="text" value="${nameCell.textContent}">`;
    emailCell.innerHTML = `<input type="email" value="${emailCell.textContent}">`;
    statusCell.innerHTML = `
                <select>
                    <option value="Active" ${statusCell.textContent === "Active" ? "selected" : ""}>Active</option>
                    <option value="Inactive" ${statusCell.textContent === "Inactive" ? "selected" : ""}>Inactive</option>
                </select>
            `;

    // Change the "Edit" button to "Save" and "Cancel"
    const actionCell = cells[5];
    actionCell.innerHTML = `
                <button class="btn btn-success" onclick="saveBranch(${branchId}, this)">Save</button>
                <button class="btn btn-secondary" onclick="cancelEdit(this)">Cancel</button>
            `;
}

// Save edited branch
function saveBranch(branchId, btn) {
    const row = btn.closest("tr");
    const cells = row.querySelectorAll("td");
    const name = cells[1].querySelector("input").value;
    const email = cells[2].querySelector("input").value;
    const status = cells[3].querySelector("select").value;

    const branch = branches.find(b => b.id === branchId);
    branch.name = name;
    branch.email = email;
    branch.status = status;

    updateTable();
}

// Cancel editing and revert back
function cancelEdit(btn) {
    updateTable();
}

// Delete a branch
function deleteBranch(id) {
    branches = branches.filter(b => b.id !== id);
    updateTable();
}

// Update table content
function updateTable() {
    const tableBody = document.querySelector("#dataTable tbody");
    tableBody.innerHTML = "";
    branches.forEach(branch => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${branch.id}</td>
            <td>${branch.name}</td>
            <td>${branch.email}</td>
            <td>${branch.status}</td>
            <td>${branch.date}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="settingsDropdown${branch.id}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown${branch.id}">
                        <li><a class="dropdown-item" href="#" onclick="enableEdit(this.closest('tr'), ${branch.id})">Edit</a></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteBranch(${branch.id})">Delete</a></li>
                    </ul>
                </div>
            </td>
        `;
        tableBody.appendChild(row);
    });
    document.getElementById("totalEntries").textContent = branches.length; // Update total entries
}

// Implement search functionality
document.getElementById("searchInput").addEventListener("input", function () {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll("#dataTable tbody tr");
    let matchedRows = 0;

    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let matchFound = false;

        cells.forEach(cell => {
            const text = cell.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                matchFound = true;
            }
        });

        if (matchFound) {
            row.style.display = "";
            matchedRows++;
        } else {
            row.style.display = "none";
        }
    });

    document.getElementById("totalEntries").textContent = matchedRows;
});

// Initialize the page with some branches
window.onload = () => {
    updateTable();
};

