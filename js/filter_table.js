function searchInput() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
                //search next item
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        //search next item
                        td = tr[i].getElementsByTagName("td")[2];
                        if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                                //search next item
                                td = tr[i].getElementsByTagName("td")[3];
                                if (td) {
                                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                        //search next item
                                        td = tr[i].getElementsByTagName("td")[4];
                                        if (td) {
                                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                            } else {
                                                tr[i].style.display = "none";
                                                //search next item
                                                td = tr[i].getElementsByTagName("td")[5];
                                                if (td) {
                                                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                        tr[i].style.display = "";
                                                    } else {
                                                        tr[i].style.display = "none";
                                                        //search next item
                                                        td = tr[i].getElementsByTagName("td")[6];
                                                        if (td) {
                                                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                                tr[i].style.display = "";
                                                            } else {
                                                                tr[i].style.display = "none";
                                                                //search next item
                                                                td = tr[i].getElementsByTagName("td")[7];
                                                                if (td) {
                                                                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                                        tr[i].style.display = "";
                                                                    } else {
                                                                        tr[i].style.display = "none";
                                                                        //search next item
                                                                        td = tr[i].getElementsByTagName("td")[8];
                                                                        if (td) {
                                                                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                                                tr[i].style.display = "";
                                                                            } else {
                                                                                tr[i].style.display = "none";
                                                                                //search next item
                                                                                td = tr[i].getElementsByTagName("td")[9];
                                                                                if (td) {
                                                                                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                                                                        tr[i].style.display = "";
                                                                                    } else {
                                                                                        tr[i].style.display = "none";
                                                                                    }
                                                                                } 
                                                                            }
                                                                        } 
                                                                    }
                                                                } 
                                                            }
                                                        } 
                                                    }
                                                } 
                                            }
                                        } 
                                    }
                                } 
                            }
                        }
                    }
                }
            }
        }
    }
}
