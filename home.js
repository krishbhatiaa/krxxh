$(function() {
    $('.modal').modal();
    console.clear();
    function getQueryStrings() {
        let queryString = location.search.substring(1).split("&");
        let qsArray = {};
        queryString.forEach(function(qs){
            let splittedQS = qs.split("=");
            let key = splittedQS[0];
            let value = splittedQS[1];

            qsArray[key] = value;
        });
        return qsArray;
    }
    function processToast() {
        const queryStrings = getQueryStrings();
        if(queryStrings.hasOwnProperty('op') && queryStrings.hasOwnProperty('status')) {
            switch(queryStrings['op']) {
                case "insert":
                    if(queryStrings['status'] == "success") {
                        M.toast({html: 'Contact Inserted Successfully!', classes: 'green darken-1'});
                    } else if(queryStrings['status'] == "failed") {
                        M.toast({html: 'Error While Inserting!', classes: 'red darken-1'});
                    }
                    break;
                case "update":
                    if(queryStrings['status'] == "success") {
                        M.toast({html: 'Contact Updated Successfully!', classes: 'green darken-1'});
                    } else if(queryStrings['status'] == "failed") {
                        M.toast({html: 'Error While Updating!', classes: 'red darken-1'});
                    }
                    break;
                case "delete":
                    if(queryStrings['status'] == "success") {
                        M.toast({html: 'Contact Deleted Successfully!', classes: 'green darken-1'});
                    } else if(queryStrings['status'] == "failed") {
                        M.toast({html: 'Error While Deleting!', classes: 'red darken-1'});
                    }
                    break;
            }
        }
    }
    processToast();
    $(".delete-btn").click(function(evt){
        console.log("Delete Clicked: ");
        const idToBeDeleted = $(this)[0].dataset.id;
        $("#deleteInput").val(idToBeDeleted);
    });
});
