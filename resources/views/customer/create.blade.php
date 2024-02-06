<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
    <!-- Include any CSS styles or external stylesheets here -->
</head>

<body>
    <h1>Create Customer</h1>

    <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Include the CSRF token -->

        <!-- Add form fields for creating a customer -->
        <label for="SN">SN:</label>
        <input type="text" name="SN" id="SN" required>

        <label for="LN">LN:</label>
        <input type="text" name="LN" id="LN" required>

        <label for="Logo">Logo:</label>
        <input type="file" name="Logo" id="Logo" accept="image/*" required>

        <label for="Description">Description:</label>
        <input type="text" name="Description" id="Description" required>

        <label for="SecteurActivite">SecteurActivite:</label>
        <input type="text" name="SecteurActivite" id="SecteurActivite" required>

        <label for="Categorie">Categorie:</label>
        <input type="text" name="Categorie" id="Categorie" required>

        <label for="Site_Web">Site_Web:</label>
        <input type="text" name="Site_Web" id="Site_Web" required>

        <label for="Adresse_mail">Adresse_mail:</label>
        <input type="text" name="Adresse_mail" id="Adresse_mail" required>

        <label for="Organigramme">Organigramme:</label>
        <input type="text" name="Organigramme" id="Organigramme" required>

        <label for="Network_Design">Network_Design:</label>
        <input type="text" name="Network_Design" id="Network_Design" required>

        <label for="Type">Type:</label>
        <input type="text" name="Type" id="Type" required>

        <!-- Add other fields as needed -->

        <button type="submit">Create Customer</button>
    </form>
</body>

</html>
