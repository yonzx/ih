<?php
include('visit/data.php');
?>
<?php include('header.php'); ?>

<body>
    <?php include('sidemenu.php'); ?>

    <div id="content">
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <h4 class="mb-0">Customer Visits</h4>
                    <button class="btn btn-light p-1 m-1" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer ID</th>
                            <th>Branch ID</th>
                            <th>Date of Visit</th>
                            <th>Time of Visit</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Deleted By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM visit";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr id='visit-row-{$row['id']}'>
                                        <td>{$row['id']}</td>
                                        <td><span class='customer-id'>{$row['customerId']}</span></td>
                                        <td><span class='branch-id'>{$row['branchId']}</span></td>
                                        <td><span class='date'>{$row['date']}</span></td>
                                        <td><span class='time'>{$row['time']}</span></td>
                                        <td><span class='created-by'>{$row['createdBy']}</span></td>
                                        <td><span class='updated-by'>{$row['updatedBy']}</span></td>
                                        <td><span class='deleted-by'>{$row['deletedBy']}</span></td>
                                        <td>
                                            <button class='btn btn-primary edit-btn' onclick='editVisit({$row['id']})'>Edit</button>
                                            <form action='visit/update_visit.php' method='POST' class='d-inline' id='update-form-{$row['id']}' onsubmit='return confirm(\"Are you sure you want to save changes?\");'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <input type='hidden' name='customerId' value='{$row['customerId']}'>
                                                <input type='hidden' name='branchId' value='{$row['branchId']}'>
                                                <input type='hidden' name='date' value='{$row['date']}'>
                                                <input type='hidden' name='time' value='{$row['time']}'>
                                                <input type='hidden' name='updatedBy' value='{$row['updatedBy']}'> <!-- Hidden field for updatedBy -->
                                                <button type='submit' class='btn btn-success save-btn input-hidden'>Save</button>
                                            </form>
                                            <form action='visit/delete.php' method='POST' class='d-inline' onsubmit='return confirm(\"Are you sure you want to delete this visit?\");'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <button type='submit' class='btn btn-danger'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>No visits found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Light/Dark Mode Toggle Button -->
            <div class="text-end">
                <button id="themeToggle" class="btn btn-primary rounded-circle"><i class="mode-icon">🌙</i></button>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Visit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="visit/visit_handler.php" method="POST">
                        <div class="mb-3">
                            <label for="customerId" class="form-label">Customer ID</label>
                            <input type="text" class="form-control" id="customerId" name="customerId" required>
                        </div>
                        <div class="mb-3">
                            <label for="branchId" class="form-label">Branch ID</label>
                            <input type="text" class="form-control" id="branchId" name="branchId" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date of Visit</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Time of Visit</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                        <div class="mb-3">
                            <label for="createdBy" class="form-label">Created By</label>
                            <input type="text" class="form-control" id="createdBy" name="createdBy" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="save_data">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function editVisit(visitId) {
            const visitRow = document.getElementById('visit-row-' + visitId);
            const customerIdCell = visitRow.querySelector('td:nth-child(2)');
            const branchIdCell = visitRow.querySelector('td:nth-child(3)');
            const dateCell = visitRow.querySelector('td:nth-child(4)');
            const timeCell = visitRow.querySelector('td:nth-child(5)');
            const updatedByCell = visitRow.querySelector('td:nth-child(7)'); // Updated By cell
            
            // Get the current values
            const customerIdSpan = customerIdCell.querySelector('.customer-id');
            const branchIdSpan = branchIdCell.querySelector('.branch-id');
            const dateSpan = dateCell.querySelector('.date');
            const timeSpan = timeCell.querySelector('.time');
            const updatedBySpan = updatedByCell.querySelector('.updated-by'); // Updated By span

            const customerIdInput = document.createElement('input');
            customerIdInput.type = 'text';
            customerIdInput.value = customerIdSpan.textContent;
            customerIdInput.className = 'form-control';
            
            const branchIdInput = document.createElement('input');
            branchIdInput.type = 'text';
            branchIdInput.value = branchIdSpan.textContent;
            branchIdInput.className = 'form-control';
            
            const dateInput = document.createElement('input');
            dateInput.type = 'date';
            dateInput.value = dateSpan.textContent;
            dateInput.className = 'form-control';
            
            const timeInput = document.createElement('input');
            timeInput.type = 'time';
            timeInput.value = timeSpan.textContent;
            timeInput.className = 'form-control';

            const updatedByInput = document.createElement('input'); // Create input for Updated By
            updatedByInput.type = 'text';
            updatedByInput.value = updatedBySpan.textContent;
            updatedByInput.className = 'form-control';

            // Replace spans with inputs
            customerIdCell.innerHTML = '';
            customerIdCell.appendChild(customerIdInput);
            
            branchIdCell.innerHTML = '';
            branchIdCell.appendChild(branchIdInput);
            
            dateCell.innerHTML = '';
            dateCell.appendChild(dateInput);
            
            timeCell.innerHTML = '';
            timeCell.appendChild(timeInput);
            
            updatedByCell.innerHTML = ''; // Clear the Updated By cell
            updatedByCell.appendChild(updatedByInput); // Add the input for Updated By

            // Show the save button
            const saveButton = document.querySelector('#update-form-' + visitId + ' .save-btn');
            saveButton.classList.remove('input-hidden');

            // Update the hidden input values when the user types
            customerIdInput.addEventListener('input', function() {
                document.querySelector('#update-form-' + visitId + ' input[name="customerId"]').value = customerIdInput.value;
            });
            
            branchIdInput.addEventListener('input', function() {
                document.querySelector('#update-form-' + visitId + ' input[name="branchId"]').value = branchIdInput.value;
            });
            
            dateInput.addEventListener('input', function() {
                document.querySelector('#update-form-' + visitId + ' input[name="date"]').value = dateInput.value;
            });
            
            timeInput.addEventListener('input', function() {
                document.querySelector('#update-form-' + visitId + ' input[name="time"]').value = timeInput.value;
            });

            updatedByInput.addEventListener('input', function() {
                document.querySelector('#update-form-' + visitId + ' input[name="updatedBy"]').value = updatedByInput.value;
            });
        }
    </script>
</body>
<?php include('footer.php'); ?>