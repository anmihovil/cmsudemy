
ClassicEditor
    .create( document.querySelector( '#body' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );

$(document).ready(function(){
$('#selectAllBoxes').click(function(event){

        if(this.checked){
        $('.checkBoxes').each(function(){
        this.checked = true;
        });
        }else{
        $('.checkBoxes').each(function(){
        this.checked = false;
        });
}
  });

  $("body").prepend("HELLO");

});



