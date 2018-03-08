$(document).ready(function() {

    $('#repo-details').dataTable({
        "bProcessing": true,
        "sAjaxSource": "../src/RepositoryDetails.php",
        "aoColumns": [
            { mData: 'ID' } ,
            { mData: 'name' },
            { mData: 'URL' },
            { mData: 'created_date' },
            { mData: 'last_push_date' },
            { mData: 'description' },
            { mData: 'stars' }
        ],
        "aaSorting": [[ 6, "desc" ]]
    });
});
