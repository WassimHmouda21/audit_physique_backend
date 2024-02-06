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
            <h1>IMAGE CRUD IN LARAVEL</h1>
            <table class="table table-stripped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id </th>
                        <th scope="col">SN</th>
                        <th scope="col">LN</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Description</th>
                        <th scope="col">SecteurActivite</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Site_Web</th>
                        <th scope="col">Adresse_mail</th>
                        <th scope="col">Organigramme</th>
                        <th scope="col">Network_Design</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th>{{ $customer->id }}</th>
                            <th>{{ $customer->SN }}</th>
                            <th>{{ $customer->LN }}</th>
                            <td> <img src="{{ asset('assets/' . $customer->Logo) }}" width="px;" height="100px;" alt="Logo"></td>
                            <th>{{ $customer->Description }}</th>
                            <th>{{ $customer->SecteurActivite }}</th>
                            <th>{{ $customer->Categorie }}</th>
                            <th>{{ $customer->Site_Web }}</th>
                            <th>{{ $customer->Adresse_mail }}</th>
                            <th>{{ $customer->Organigramme }}</th>
                            <th>{{ $customer->Network_Design }}</th>
                            <th>{{ $customer->Type }}</th>
                            <th>Actions Column Content</th> <!-- Replace with your actions content -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
