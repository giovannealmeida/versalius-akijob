/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var loadFile = function (event) {
    var output = document.getElementById('preview_image');
    output.src = URL.createObjectURL(event.target.files[0]);
};
