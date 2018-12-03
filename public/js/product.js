$(function() {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('product.anydata') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'slug', name: 'slug' },
            { data: 'description', name: 'description' },
            { data: 'sale_price', name: 'sale_price' },
            { data: 'origin_price', name: 'origin_price' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' }
        ]
    });
});