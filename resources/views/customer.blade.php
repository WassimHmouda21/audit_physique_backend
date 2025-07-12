<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1> Image CRUD in laravel</h1><br>
            <form action="{{ route('addImage') }}" method="POST" enctype="multipart/form-data">

         <div class="form.group">
         <label for="SN">SN:</label>
        <input type="text" name="SN" class="form-control" placeholder="Enter text">

         </div>
         <div class="form.group">
         <label for="LN">LN:</label>
        <input type="text" name="LN" class="form-control" placeholder="Enter text">
         </div>
         <div class="input.group">
            <div class="cutom.file">
                <input type="file" name="Logo" class="custom.file.input" >
                <label class="custom.file.label">Choose file></label>

         </div>
         <div class="form.group">
         <label for="Description">Description:</label>
        <input type="text" name="Description" class="form-control" placeholder="Enter text">

</div>
<div class="form.group">
    <label for="SecteurActivite">SecteurActivite:</label>
        <input type="text" name="SecteurActivite" class="form-control" placeholder="Enter text">

</div>
<div class="form.group">
<label for="Categorie">Categorie:</label>
        <input type="text" name="Categorie" class="form-control" placeholder="Enter text">
</div>
<div class="form.group">

<label for="Site_Web">Site_Web:</label>
        <input type="text" name="Site_Web"  class="form-control" placeholder="Enter text">

</div>
<div class="form.group">
<label for="Adresse_mail">Adresse_mail:</label>
        <input type="text" name="Adresse_mail" class="form-control" placeholder="Enter text">
</div>
<div class="form.group">
<label for="Organigramme">Organigramme:</label>
        <input type="text" name="Organigramme" class="form-control" placeholder="Enter text">
</div>
<div class="form.group">
<label for="Network_Design">Network_Design:</label>
        <input type="text" name="Network_Design" class="form-control" placeholder="Enter text">
</div>
<div class="form.group">
<label for="Type">Type:</label>
        <input type="text" name="Type" class="form-control" placeholder="Enter text">
</div>
<br><br>
<button type="submit" name="submit" class="btn btn.primary btn.lg"> Save Data </button>
</form>
</div>
</div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1> Image CRUD in Laravel</h1><br>
            <form action="{{ route('addImage') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Add CSRF token for Laravel forms -->
                <div class="form-group">
                    <label for="SN">SN:</label>
                    <input type="text" name="SN" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="LN">LN:</label>
                    <input type="text" name="LN" class="form-control" placeholder="Enter text">
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="Logo" class="custom-file-input">
                        <label class="custom-file-label">Choose file</label> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <input type="text" name="Description" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="SecteurActivite">SecteurActivite:</label>
                    <input type="text" name="SecteurActivite" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="Categorie">Categorie:</label>
                    <input type="text" name="Categorie" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="Site_Web">Site_Web:</label>
                    <input type="text" name="Site_Web" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="Adresse_mail">Adresse_mail:</label>
                    <input type="text" name="Adresse_mail" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="Organigramme">Organigramme:</label>
                    <input type="text" name="Organigramme" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="Network_Design">Network_Design:</label>
                    <input type="text" name="Network_Design" class="form-control" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label for="Type">Type:</label>
                    <input type="text" name="Type" class="form-control" placeholder="Enter text">
                </div>
                <br><br>
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Save Data</button>
            </form>
        </div>
    </div>
</body>
</html>
