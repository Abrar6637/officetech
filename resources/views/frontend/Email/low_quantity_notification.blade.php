<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p>Hello Admin,</p>

    @if($lowQuantityProducts->isNotEmpty())
        <p>The following products have low quantity:</p>
        <table border="1">
            <thead>
                <tr>
                    <th>Product SKU</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lowQuantityProducts as $product)
                    <tr>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No low-quantity products found.</p>
    @endif

    <p>Regards,<br>Office Supplies</p>
</body>
</html>
