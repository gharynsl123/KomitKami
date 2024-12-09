<table>
    <thead>
        <tr>
            <th>Product Name</th>
            @foreach($months as $month)
            <th>{{ $month }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($monthlyPurchases as $productName => $purchases)
        <tr>
            <td>{{ $productName }}</td>
            @foreach($months as $month)
            <td>{{ $purchases[$month] }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>