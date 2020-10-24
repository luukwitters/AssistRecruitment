// Function to show and hide the maintence sub menu
function maintenceSubMenu(){
    // Ophalen van element
    var submenu = document.getElementById("maintanceSubmenu");

    // CSS class toevoegen als die er niet op staan en verwijderen als ze er wel op staan
    submenu.classList.toggle("submenu--show");
}

// Filling the progress bar per scan on the index page
function setProgressbarScan(scanCircle, progress) {
    // Getting the circle
    var circle = document.getElementById(scanCircle);
    // Getting the radius of the circle
    var radius = circle.r.baseVal.value;
    // calculating the with
    var circumference = radius * 2 * Math.PI;

    circle.style.strokeDasharray = `${circumference} ${circumference}`;
    circle.style.strokeDashoffset = `${circumference}`;

    // Calculating the progress
    function setProgress(percent) {
        const offset = circumference - percent / 100 * circumference;
        circle.style.strokeDashoffset = offset;
    }

    // Setting the progress
    setProgress(progress);

    // input.addEventListener('change', function(e) {
    //     if (input.value < 101 && input.value > -1) {
    //         setProgress(input.value);
    //     }  
    // })
}

// Test function to sort the tables
function sortTable(sortTable, tableColumn, direction) {
    var table, column, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0, tableIconTop, tableIconBottom, restTableIconTop, restTableIconBottom;
    // Getting the table and the column
    table = document.getElementById(sortTable);
    column = document.getElementById(tableColumn);

    // Getting the sorting icons
    tableIconTop = document.getElementById(sortTable).getElementsByClassName("table__icon-top")[tableColumn];
    tableIconBottom = document.getElementById(sortTable).getElementsByClassName("table__icon-bottom")[tableColumn];  

    // Getting the other sorting icons
    restTableIconTop = document.querySelector("#" + CSS.escape(sortTable) + " .table__icon-top").classList.remove("table__icon-active");
    restTableIconBottom = document.querySelector("#" + CSS.escape(sortTable) + " .table__icon-bottom").classList.remove("table__icon-active");

    console.log(tableIconTop);
    console.log(tableIconBottom);

    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[tableColumn];
            y = rows[i + 1].getElementsByTagName("TD")[tableColumn];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (direction == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;

                    // Styling the column icons
                    tableIconTop.classList.add("table__icon-active");
                    tableIconBottom.classList.remove("table__icon-active");

                    break;
                }
            } else if (direction == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;

                   // Styling the column icons
                   tableIconTop.classList.remove("table__icon-active");
                   tableIconBottom.classList.add("table__icon-active");

                    break;
                }
            }
        }

        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

// function to get url of customer edit and change a overview status
// Checking the table status
function updateTableStatus(overviewTable, overviewStatus) { 
    // Checking wich table has been clicked
    var status = document.getElementById(overviewStatus).value;
    // Getting the url of
    var url = window.location.href.toString();

    console.log(url);

    // Checking wich table status has been updated
    switch (overviewTable) {
        case "Departments":
            // Checking if department status has been changed
            if (url.includes("department-status", 0)) {
                // Looking in the url for the parameter and value to replace with the new status
                var newUrl = url.replace(/\bdepartment-status=[a-zA-Z]{1,50}\b/, 'department-status=' + status);

                // Refreshing the page with the new url
                location.replace(newUrl);
            } else {
                // The status has not yet been updated so the status is placed new in the url
                location.replace(url + "&department-status=" + status);
            }
            break;
    
        case "Scans":
            // Checking if scan status has been changed
            if (url.includes("scan-status", 0)) {
                // Looking in the url for the parameter and value to replace with the new status
                var newUrl = url.replace(/\bscan-status=[a-zA-Z]{1,50}\b/, 'scan-status=' + status);

                // Refreshing the page with the new url
                location.replace(newUrl);
            } else {
                // The status has not yet been updated so the status is placed new in the url
                location.replace(url + "&scan-status=" + status);
            }
            break;

        default:
            // Checking if scan status has been changed
            if (url.includes("user-status", 0)) {
                // Looking in the url for the parameter and value to replace with the new status
                var newUrl = url.replace(/\buser-status=[a-zA-Z]{1,50}\b/, 'user-status=' + status);

                // Refreshing the page with the new url
                location.replace(newUrl);
            } else {
                // The status has not yet been updated so the status is placed new in the url
                location.replace(url + "&user-status=" + status);
            }
            break;
    }
}

// Function to go to the details page onclick of table cell
function toDetails(overviewTable, overviewID, customerID){
    // Checking wich table has been clicked
    switch (overviewTable) {
        case "Departments":
            location.allign("department-edit?department=" + overviewID + "&customer=" + customerID);
            //console.log("department-edit?department=" + overviewID + "&customer=" + customerID);
            break;
        case "Scans":
            location.assign("scan-edit?scan=" + overviewID + "&customer=" + customerID);
            break;
        default:
            location.assign("user-edit?user=" + overviewID + "&customer=" + customerID);
            break;
    }
}

// Function to autocomplete existing user
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");

        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

// Opening a new table with all results on qaTable
function openQuestionAnswers(tableRowAV, tableRowQA, expendIcon) {
    // Getting the tablee row and giving or removing class row--hidden
    document.getElementById(tableRowAV).classList.toggle("av__row-active");
    document.getElementById(tableRowQA).classList.toggle("row--hidden");
    document.getElementById(expendIcon).classList.toggle("expend-icon");
}

// Setting the customer select on user-edit on disabeld when the user is connected to a customer
function setCustomerSelectDisabeld() {
    document.getElementById("customerSelect").disabled = true;
}

// Function to udate the customer ID
function changeSelectCustomer() {
    document.getElementById("custID").value = document.getElementById("customerSelect").value;
}

// Function to set scanID from the overview and use it in the modal
function setScanIDModal(scanID) {
    // Setting the value of the scan id in the modal
    document.getElementById("scanIDDisconnect").value = scanID;
}
// Function to get department and use it in the modal
function setContactIDModalCustomerEdit(contactID) {
    document.getElementById("ContactIDArchive").value = contactID;
    document.getElementById("ContactIDDelete").value = contactID;
}

// Function to get department and use it in the modal
function setDepartmentIDModalCustomerEdit(departmentID) {
    document.getElementById("departmentIDArchive").value = departmentID;
    document.getElementById("departmentIDDelete").value = departmentID;
}

// Function to get scan and use it in the modal
function setScanIDModalCustomerEdit(scanID) {
    document.getElementById("ScanIDArchive").value = scanID;
    document.getElementById("ScanIDDelete").value = scanID;
}
