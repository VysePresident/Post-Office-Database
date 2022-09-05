// if document is finished loading, call ready() to listen for events 
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready();
}


function ready() {
    // collect all of the side bar buttons 
    var sideBarButtons = document.getElementsByClassName('icons');
    
    // listen to see if any of the side bar buttons were clicked
    for (var i = 0; i < sideBarButtons.length; i++) {
        var sideBarButton = sideBarButtons[i];
        sideBarButton.addEventListener('click', sideBarButtonClicked);
    }

    // listen to see when the edit button in employee information is clicked
    var empEditButton = document.getElementById('emp-edit-info-btn');
    empEditButton.addEventListener('click', empEditButtonClicked);
}

// flip employee display information to edit info form
function empEditButtonClicked(event) {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will probably be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        <h5>Employee Information</h5>
                    </span>
                    </div>

                    <form method="post" action="">
                    <div>
                        <span>
                            <h2>First Name</h2>
                        </span>
                    </div>
                    <input type="text" name="fname" placeholder="Enter your updated first name" required>

                    <div>
                        <span>
                            <h2>Last Name</h2>
                        </span>
                    </div>
                    <input type="text" name="lname" placeholder="Enter your updated last name" required>

                    <div>
                        <span>
                            <h2>Employee ID</h2>
                        </span>
                    </div>
                    <input type="text" name="employee-id" placeholder="Employee ID" required>

                    <div>
                        <span>
                            <h2>Address</h2>
                        </span>
                    </div>
                    <input type="text" name="address" placeholder="Enter your updated address" required>

                    <div>
                        <span>
                            <h2>Phone Number</h2>
                        </span>
                    </div>
                    <input type="text" name="phone-number" placeholder="Enter your updated phone number" required>

                    <div>
                        <span>
                            <h2>Works At</h2>
                        </span>
                    </div>
                    <input type="text" name="location" placeholder="Post Office Location" required>

                    <button type="submit" class="hero-btn red-btn" id="emp-save-info-btn">Save Information</button>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

                    </form>`

    formBox.innerHTML = formContent;
    contents.append(formBox);
    
    // now listen for when submit button is clicked
    var empSubmitButton = document.getElementById('emp-save-info-btn');
    empSubmitButton.addEventListener('click', empSubmitButtonClicked);
}

// flip employee edit info back to display employee info view
function empSubmitButtonClicked(event) {
    alert('Your information has been saved');

    // flip back to the display info
    createEmployeInformation();
}

// find out which side bar button was clicked by using the inner text in it's p tag
function sideBarButtonClicked(event) {
    if (event.target.innerText == "Employee Information") {
        createEmployeInformation();
    } else if (event.target.innerText == "Create Package") {
        createPackage();
    } else if (event.target.innerText == "Update Tracking") {
        createUpdateTracking();
    } else if (event.target.innerText == "Update Inventory") {
        createUpdateInventory();
    }
}


// display employee information
function createEmployeInformation() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>
                            <h5>Employee Information</h5>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>First Name</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">Johnny</p>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Last Name</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">Smith</p>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Employee ID</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">1891004</p>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Address</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">123 Sesame Street</p>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Phone Number</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">0123456789</p>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Works At</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">Houston Location</p>
                        </span>
                    </div>

                    <button class="hero-btn red-btn" id="emp-edit-info-btn">Edit Information</button>


                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>`;

    formBox.innerHTML = formContent;
    contents.append(formBox);

    // need to turn even listener back on for event button. still not 100% sure why I have to set it back on again. 
    // my theory is that the remove() function turned off the event listener. 
    var empEditButton = document.getElementById('emp-edit-info-btn');
    empEditButton.addEventListener('click', empEditButtonClicked);
}

// display create package information 
function createPackage() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                        <i class="fa fa-dropbox" aria-hidden="true"></i>
                        <span>
                            <h5>Create Package</h5>
                        </span>
                    </div>

                    <form method="post" action="">
                        <div>
                            <span>
                                <h2>Customer ID</h2>
                            </span>
                        </div>
                        <input type="text" name="customer-id" placeholder="Enter customer's id" required>
                    <button type="submit" class="hero-btn red-btn" id="create-get-pkg-info-btn">Get Package Info</button>

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>`;

    formBox.innerHTML = formContent;
    contents.append(formBox);

    var createPkgGetInfoBtn = document.getElementById('create-get-pkg-info-btn');
    createPkgGetInfoBtn.addEventListener('click', createPkgGetInfoBtnClicked);
    // BE CAREFUL: DON'T FORGET TO TURN ON ANY DELETED BUTTONS FROM CREATE PACKAGE IF YOU USE REMOVE
}

function createPkgGetInfoBtnClicked(event) {
    displayPackageInformation();
}

function displayPackageInformation() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                        <i class="fa fa-dropbox" aria-hidden="true"></i>
                        <span>
                            <h5>Package Info For Johnny</h5>
                        </span>
                    </div>
            
                    <div>
                        <span>
                            <h2>Package Sent From</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <p id="display-info">Post Office Start</p>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Package Information</h2>
                        </span>
                    </div>

                    
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Package ID</th>
                                <th>Destination Address</th>
                                <th>Price</th>
                                <th>State</th>
                                <th>Zipcode</th>
                                <th>Package Weight (lbs)</th>
                                <th>Package Volume (lbs^3)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123456789</td>
                                <td>123 Sessame Street</td>
                                <td>88,110</td>
                                <td>Texas</td>
                                <td>12345</td>
                                <td>30</td>
                                <td>40</td>
                            </tr>
                        </tbody>
                    </table>

                    <form method="post" action="">
                        <div>
                            <span>
                                <h2>Send To Next Post Office</h2>
                            </span>
                        </div>
                        <input type="text" name="fname" placeholder="Enter new post office to ship to" required>
                    <button type="submit" class="hero-btn red-btn" id="create-pkg-send-to">Send</button>

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>`;

    formBox.innerHTML = formContent;
    contents.append(formBox);

    var createPkgGetSendBtn = document.getElementById('create-pkg-send-to');
    createPkgGetSendBtn.addEventListener('click', createPkgGetSendBtnClicked);

    // BE CAREFUL: DON'T FORGET TO TURN ON ANY DELETED BUTTONS FROM CREATE PACKAGE IF YOU USE REMOVE
}

function createPkgGetSendBtnClicked(event) {
    alert('Package has been sent');

    // go back to create package screen incase they'd like to enter a new ID
    createPackage();
}

function createUpdateTracking() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>
                            <h5>Update Tracking</h5>
                        </span>
                    </div>

                    <form method="post" action="">
                        <div>
                            <span>
                                <h2>Package ID</h2>
                            </span>
                        </div>
                        <input type="text" name="customer-id" placeholder="Enter package's id" required>
                    <button type="submit" class="hero-btn red-btn" id="update-track-get-info">Get Package Info</button>

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>`;

    formBox.innerHTML = formContent;
    contents.append(formBox);

    var updateTrackGetInfoBtn = document.getElementById('update-track-get-info');
    updateTrackGetInfoBtn.addEventListener('click', updateTrackGetInfoBtnClicked);
    // BE CAREFUL: DON'T FORGET TO TURN ON ANY DELETED BUTTONS FROM CREATE PACKAGE IF YOU USE REMOVE
}

function updateTrackGetInfoBtnClicked(event) {
    displayPackageInfoForUpdateTracking();
}

function displayPackageInfoForUpdateTracking() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>
                            <h5>Package Info For ID: 123456789</h5>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Package HISTORY</h2>
                        </span>
                    </div>

                    
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Package ID</th>
                                <th>Destination Address</th>
                                <th>Price</th>
                                <th>State</th>
                                <th>Zipcode</th>
                                <th>Package Weight (lbs)</th>
                                <th>Package Volume (lbs^3)</th>
                                <th>Arrived At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123456789</td>
                                <td>123 Sessame Street</td>
                                <td>88,110</td>
                                <td>Texas</td>
                                <td>12345</td>
                                <td>30</td>
                                <td>40</td>
                                <td>Post Office</td>
                            </tr>
                        </tbody>
                    </table>

                    <form method="post" action="">
                        <div>
                            <span>
                                <h2>Enter Current Post Office</h2>
                            </span>
                        </div>
                        <input type="text" name="fname" placeholder="Enter current post office" required>

                        <div>
                            <span>
                                <h2>Enter Date</h2>
                            </span>
                        </div>
                        <input type="text" name="fname" placeholder="Enter today's date" required>
                    <button type="submit" class="hero-btn red-btn" id="update-track-enter">Enter</button>

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>`;

    formBox.innerHTML = formContent;
    contents.append(formBox);

    var updateTrackEnterBtn = document.getElementById('update-track-enter');
    updateTrackEnterBtn.addEventListener('click', updateTrackEnterBtnClicked);

    // BE CAREFUL: DON'T FORGET TO TURN ON ANY DELETED BUTTONS FROM CREATE PACKAGE IF YOU USE REMOVE
}

function updateTrackEnterBtnClicked(event) {
    alert('Tracking has been updated');

    // go back to update trackiing page start in case they'd like to enter a new package
    createUpdateTracking();
}

function createUpdateInventory() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                    <i class="fa fa-book" aria-hidden="true"></i>
                        <span>
                            <h5>Update Inventory</h5>
                        </span>
                    </div>

                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Inventory Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>item </td>
                                <td>1.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 2</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 3</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 4</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 5</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="hero-btn red-btn" id="update-inventory-btn">Update</button>

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>`;

    formBox.innerHTML = formContent;
    contents.append(formBox);

    var updateInventoryBtn = document.getElementById('update-inventory-btn');
    updateInventoryBtn.addEventListener('click', updateInventoryBtnClicked);
    // BE CAREFUL: DON'T FORGET TO TURN ON ANY DELETED BUTTONS FROM CREATE PACKAGE IF YOU USE REMOVE
}

function updateInventoryBtnClicked(event) {
    displayUpdateInventoryOption();
}

function displayUpdateInventoryOption() {
    // BE CAREFUL: if you have multiple forms (form-col classes) in one of the side bar options, this won't grab all of them.
    // a soltuion using getElementById will probably be necessary.
    var oldFormContent = document.getElementsByClassName('form-col')[0];
    oldFormContent.remove();

    var formBox = document.createElement('div'); 
    formBox.classList.add('form-col');
    var contents = document.getElementsByClassName('content')[0];
    
    var formContent = `
                    <div>
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>
                        <h5>Update Inventory</h5>
                    </span>
                    </div>

                    <form method="post" action="">
                    <div>
                        <span>
                            <h2>Item Name</h2>
                        </span>
                    </div>
                    <input type="text" name="item-name" placeholder="Enter item's name" required>

                    <div>
                        <span>
                            <h2>Price</h2>
                        </span>
                    </div>
                    <input type="text" name="price" placeholder="Enter your item's updated price" required>

                    <div>
                        <span>
                            <h2>Count Increase</h2>
                        </span>
                    </div>
                    <input type="text" name="count-inc" placeholder="Enter item's increase" required>

                    <button type="submit" class="hero-btn red-btn" id="update-inventory-confirm">Confirm</button>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

                    </form>`

    formBox.innerHTML = formContent;
    contents.append(formBox);
    
    // now listen for when submit button is clicked
    var updateInventoryConfirmBtn = document.getElementById('update-inventory-confirm');
    updateInventoryConfirmBtn.addEventListener('click', updateInventoryConfirmBtnClicked);
}

function updateInventoryConfirmBtnClicked(event) {
    alert('Update has been applied');

    // take them back to inventory view
    createUpdateInventory();
}