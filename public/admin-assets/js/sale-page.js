$(document).ready(function() {
    setTimeout(function() {
        $('.select2-select').select2();

        $('#product_id').select2({
            placeholder: 'Choose Product',
            allowClear: true 
        });

        $('#expense_id').select2({
            placeholder: 'Choose Expense',
            allowClear: true 
        });

        $('#customer_id').select2({
            placeholder: 'Choose Customer',
            allowClear: true 
        });
    }, 500);

    // Handle product selection
    $('#product_id').on('change', function() {
        var productId = $(this).val();
        if (!productId) return;

        if ($('#myTable tbody tr[data-id="' + productId + '"]').length > 0) {
            alert('Product already added to the table.');
            return;
        }

        var productName = $(this).find(':selected').data('name');
        var productPrice = $(this).find(':selected').data('price');
        var sku = $(this).find(':selected').data('sku');
 
        var productQuantity = $(this).find(':selected').data('quantity');
        var initialQuantity = 1;
        var subtotal = productPrice * initialQuantity;

        var row = `
            <tr data-id="${productId}" data-type="product" data-sku="${sku}">
                <td>${productName}</td>
                <td>${sku}</td>
                <td>
                    <input type="number" class="form-control sale-price-input" value="${productPrice}" min="1" step="0.001">
                </td>
                <td>
<div class="input-group quantity-group">
    <input type="number" 
           class="form-control quantity-input" 
           value="${initialQuantity}" 
           min="0.01" 
           step="0.01">
</div>
                </td>
                <td class="subtotal">${subtotal}</td>
                <td><button class="btn btn-danger btn-sm delete-row"><i class="fa fa-trash"></i></button></td>
            </tr>
        `;

        $('#myTable tbody').append(row);
        updateSubtotal();
        $('#product_id').val(null).trigger('change');
    });

    // Handle expense selection
    $('#expense_id').on('change', function() {
        var expenseId = $(this).val();
        if (!expenseId) return;

        var uniqueId = 'expense_' + expenseId;

        if ($('#myTable tbody tr[data-id="' + uniqueId + '"]').length > 0) {
            alert('Expense already added to the table.');
            return;
        }

        var expenseName = $(this).find(':selected').data('name');
        var expensePrice = $(this).find(':selected').data('price');
        var expenseQuantity = $(this).find(':selected').data('quantity');
        var sku = $(this).find(':selected').data('sku');
        var initialQuantity = 1;
        var subtotal = expensePrice * initialQuantity;

        var row = `
            <tr data-id="${uniqueId}" data-type="expense" data-sku="${sku}">
                <td>${expenseName} <small class="text-muted">(Expense)</small></td>
                <td>Not Available</td>
                <td>
                    <input type="number" class="form-control sale-price-input" value="${expensePrice}" min="1" step="0.001">
                </td>
                <td>
                  <div class="input-group quantity-group">
    <input type="number" 
           class="form-control quantity-input" 
           value="${initialQuantity}" 
           min="0.01" 
           step="0.01">
</div>

                </td>
                <td class="subtotal">${subtotal}</td>
                <td><button class="btn btn-danger btn-sm delete-row"><i class="fa fa-trash"></i></button></td>
            </tr>
        `;

        $('#myTable tbody').append(row);
        updateSubtotal();
        $('#expense_id').val(null).trigger('change');
    });

    // Handle row delete
    $('#myTable').on('click', '.delete-row', function() {
        $(this).closest('tr').remove();
        updateSubtotal();
    });

    // Handle price/quantity change
    $('#myTable').on('input', '.quantity-input, .sale-price-input', function() {
        tableInputChange(this);
    });

    function tableInputChange(element){
        var tr = $(element).closest('tr');
        var quantity = $(tr.find(".quantity-input")).val();
        var price = $(tr.find(".sale-price-input")).val();
        var subtotal = quantity * price;
        $(tr.find('.subtotal')).text(subtotal);
        updateSubtotal();
    }

    // Handle labour cost and discount
    $('#labour_cost, #discount').on('input', function() {
        updateSubtotal();
    });

    function updateSubtotal() {
        var total = 0;
        $('#myTable tbody tr').each(function() {
            total += parseFloat($(this).find('.subtotal').text());
        });
        $('#subtotal').val(total.toFixed(2));

        var labourCost = parseFloat($('#labour_cost').val()) || 0;
        var discount = parseFloat($('#discount').val()) || 0;
        var netTotal = total + labourCost - discount;
        $('#net_total').val(netTotal.toFixed(2));
    }

    // Auto select input value on focus
    $(document).on('click', 'input', function() {
        $(this).select();
    });

    // Enforce min/max values
    $(document).on('input', 'input', function() {
        var min = parseInt($(this).attr('min'));
        var max = parseInt($(this).attr('max'));
        var value = parseInt($(this).val());

        if (value < min) $(this).val(min);
        else if (value > max) $(this).val(max);
    });

    // Form submit
    $('#salesForm').on('submit', function(event) {
        event.preventDefault();

        if ($('#myTable tbody tr').length === 0) {
            alert('You did not select any product.');
            return;
        }

        var products = [];

        $('#myTable tbody tr').each(function() {
            var rawId = $(this).data('id');
            var isExpense = rawId.toString().startsWith('expense_');
            var productId = isExpense ? rawId.replace('expense_', '') : rawId;

            var productUnit = $(this).find('.sale-price-input').val();
            var productQuantity = $(this).find('.quantity-input').val();
            var productSubtotal = $(this).find('.subtotal').text();
            var productSku = $(this).data('sku'); // ✅ get sku from tr attribute
         


            products.push({
                product_id: productId,
                sku: productSku ?? null,
                unit_price: productUnit,
                quantity: productQuantity,
                sub_total: productSubtotal,
                type: isExpense ? 'expense' : 'product'
            });
        });

        $('#products').val(JSON.stringify(products));
        this.submit();
    });
});
