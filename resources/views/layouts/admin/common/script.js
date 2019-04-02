// // $("#productImageAdd").click(function(){

// //     // Finding total number of elements added
// //     var total_element = $(".productImages").length;
// //     // last <div> with element class id
// //     var lastid = $(".productImages:first").attr("id");
// //     var split_id = lastid.split("_");
// //     var nextindex = Number(split_id[1]) + 1;
// //     var max = 5;

// //     // Check total number elements
// //     if(total_element < max ){
// //         // alert(total_element);
// //         // Adding new div container after last occurance of element class
// //         $(".productImages:first").before("<div class='form-group row productImages' id='div_"+ nextindex +"'></div>");

// //         // Adding element to <div>
// //         $("#div_" + nextindex).append('<label class="col-3 col-form-label">Image '+ nextindex + '</label>'
// //                 +   '<div class="controls col-2">'
// //                 +       '<div class="fileupload fileupload-new" data-provides="fileupload">'
// //                 +           '<button type="button" class="btn btn-secondary btn-file">'
// //                 +               '<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>'
// //                 +               '<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>'
// //                 +               '<input type="file" class="btn-secondary" name="multiple_images[]" />'
// //                 +           '</button>'
// //                 +           '<span class="fileupload-preview" style="margin-left:5px;"></span>'
// //                 +           '<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>'
// //                 +       '</div>'
// //                 +   '</div>'
// //                 +   '<div class="col-2 sort'+ (nextindex-1) + '">'
// //                 +       '<input type="number" min="1" name="sort[]" id="sort" class="form-control">'
// //                 +   '</div>');

// //     }

// // });
// // $('.productImageRemove').click(function () {
// //     // e.preventDefault();
// //     var id = $(".productImages:first").attr("id");
// //     // alert(id);
// //     var split_id = id.split("_");
// //     var deleteindex = split_id[1];
// //     // alert(deleteindex);
// //     // Remove <div> with id
// //     if(deleteindex > 1 ){
// //         $("#div_" + deleteindex).remove();
// //     }
// //     else{
// //         alert("Sorry! You cannot delete last element");
// //     }

// // });

// // var i = <?php if(isset($max)){
// //     echo $max;
// // }else{
// //     echo 1;
// // } ?>;
// // alert(i);

// // $(document).on("click", ".productImageRemove", function() {
// //     var id = $(this).attr("id");
// //     // alert(id);
// //     alert(i);
// //     $("#" + id)
// //     .closest("#div_"+id).remove();
// //     i--;
// // });

// // // alert(i);
// // $(document).on("click", "#productImageAdd", function() {
// //     var html_row = "";
// //     i++;
// //     html_row ='<div class="form-group row productImages" id="div_'+i+'">'
// //         +          '<label class="col-3 col-form-label">Image </label>'
// //         +          '<div class="controls col-2">'
// //         +               '<div class="fileupload fileupload-new" data-provides="fileupload">'
// //         +                   '<button type="button" class="btn btn-secondary btn-file">'
// //         +                       '<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>'
// //         +                       '<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>'
// //         +                       '<input type="file" class="btn-secondary" name="multiple_images[]" />'
// //         +                   '</button>'
// //         +                   '<span class="fileupload-preview" style="margin-left:5px;"></span>'
// //         +                   '<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>'
// //         +               '</div>'
// //         +           '</div>'
// //         +           '<div class="col-2">'
// //         +               '<input type="number" min="1" name="sort[]" id="sort" class="form-control">'
// //         +           '</div>'
// //         +           '<div class="col-2">'
// //         +               '<span class="productImageRemove" id="'+i+'"><i class="fa fa-2x fa-minus-circle"></i></span>'
// //         +           '</div>'
// //         +   '</div>';
// //     alert(i);
// //     $(html_row).insertBefore("#div_"+ <?php if(isset($max)) echo ($max-$max+1); if(!isset($max)) echo '(i-1)'; ?>);
// //     // $("#images").append(html_row);
// // });        });

// // For Creating Multiple Images

// var i = <? php if (isset($max)) {
//     echo $max;
// } else {
//     echo 1;
// } ?>;
// alert(i);

// $(document).on("click", ".productImageRemove", function () {
//     var id = $(this).attr("id");
//     // alert(id);
//     alert(i);
//     $("#" + id)
//         .closest("#div_" + id).remove();
//     i--;
// });

// // alert(i);
// $(document).on("click", "#productImageAdd", function () {
//     var html_row = "";
//     i++;
//     html_row = '<div class="form-group row productImages" id="div_' + i + '">'
//         + '<label class="col-3 col-form-label">Image </label>'
//         + '<div class="controls col-2">'
//         + '<div class="fileupload fileupload-new" data-provides="fileupload">'
//         + '<button type="button" class="btn btn-secondary btn-file">'
//         + '<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>'
//         + '<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>'
//         + '<input type="file" class="btn-secondary" name="multiple_images[]" />'
//         + '</button>'
//         + '<span class="fileupload-preview" style="margin-left:5px;"></span>'
//         + '<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>'
//         + '</div>'
//         + '</div>'
//         + '<div class="col-2">'
//         + '<input type="number" min="1" name="sort[]" id="sort" class="form-control">'
//         + '</div>'
//         + '<div class="col-2">'
//         + '<span class="productImageRemove" id="' + i + '"><i class="fa fa-2x fa-minus-circle"></i></span>'
//         + '</div>'
//         + '</div>';
//     alert(i);
//     $(html_row).insertBefore("#div_" + <? php if (isset($max)) echo($max - $max + 1); if (!isset($max)) echo '(i-1)'; ?>);
//         // $("#images").append(html_row);
//         });
