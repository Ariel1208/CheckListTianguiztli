document.getElementById("file").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader.onload = function(){
    let image = document.getElementById('preview');

    image.src = reader.result;

        $('#card').empty().append(image);
  };
}

document.getElementById("file-edit").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
  let reader2 = new FileReader();

  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
  reader2.readAsDataURL(e.target.files[0]);

  // Le decimos que cuando este listo ejecute el código interno
  reader2.onload = function(){
    let image = document.getElementById('preview-edit');

    image.src = reader2.result;

    $('#card-edit').empty().append(image);
  };
}