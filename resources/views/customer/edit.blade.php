<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <!-- Include any CSS styles or external stylesheets here -->
</head>

<body>
    <h1>Edit Customer</h1>

    <!-- Form to edit customer details -->
    <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Assuming you are using the PUT method for updates -->

        <!-- Add form fields for editing customer data -->
        <label for="SN">SN:</label>
        <input type="text" name="SN" value="{{ $customer->SN }}" required>

        <label for="LN">LN:</label>
        <input type="text" name="LN" value="{{ $customer->LN }}" required>

        <label for="Logo">Logo:</label>
        <input type="file" name="Logo">

        <label for="Description">Description:</label>
        <textarea name="Description" required>{{ $customer->Description }}</textarea>

        <label for="SecteurActivite">SecteurActivite:</label>
        <input type="text" name="SecteurActivite" value="{{ $customer->SecteurActivite }}" required>

        <label for="Categorie">Categorie:</label>
        <input type="text" name="Categorie" value="{{ $customer->Categorie }}" required>

        <label for="Site_Web">Site_Web:</label>
        <input type="text" name="Site_Web" value="{{ $customer->Site_Web }}" required>

        <label for="Adresse_mail">Adresse_mail:</label>
        <input type="text" name="Adresse_mail" value="{{ $customer->Adresse_mail }}" required>

        <label for="Organigramme">Organigramme:</label>
        <input type="text" name="Organigramme" value="{{ $customer->Organigramme }}" required>

        <label for="Network_Design">Network_Design:</label>
        <input type="text" name="Network_Design" value="{{ $customer->Network_Design }}" required>

        <label for="Type">Type:</label>
        <input type="text" name="Type" value="{{ $customer->Type }}" required>

        <!-- Add other form fields as needed -->

        <button type="submit">Update Customer</button>
    </form>

    <!-- Include any scripts or JS files here if needed -->
</body>

</html>
