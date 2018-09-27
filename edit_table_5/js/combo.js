$(function() {
/* Bind Change Event to Select (First) */
$('select.first').on('change', function() {

    /* Set Value to Variable */
    var selectedText = $(this).val();
    console.log(selectedText);
    /* Append Variable as Text to Next <td/> */
    //$(this).parents('td').next().text(selectedText);
}).change(); // Run Change on Init

/* Bind Change Event to Select (Second) */
//$('select.second').on('change', function() {
    /* Set Value to Variable */
    //var selectedText = $(this).val();
    
    /* Append Variable as Text to 2nd <td/> */
    //$(this).parents('td').nextAll().eq(1).text(selectedText);
//}).change(); // Run Change on Init

/* Bind Change Event to Select (Target Class) */
//$('select.targetClass').on('change', function() {
    /* Set Value to Variable */
    var selectedText = $(this).val();
    
    /* Append Variable as Text to <td.targetedClass/> */
  //  $(this).parents('td').siblings('.targetedClass').text(selectedText);
//}).change(); // Run Change on Init
});