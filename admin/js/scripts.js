$(document).ready(function() {

    // Funtion calling summernote
    $('#summernote').summernote({

        // Increasing the height to summernote editor
        height: 200
        
    });

    // Function selecting all checkboxes
    $('.allCheckBoxes').click(function(event){


        // the variable this belongs to class allCheckedBoxes
        if(this.checked){

            // the variable this belongs to class checkBoxes
            $('.checkBox').each(function(){

                this.checked = true;
   
            });

        } else {
            // the variable this belongs to class checkBoxes
            $('.checkBox').each(function(){

                this.checked = false;
       
            });
        }

    });


});