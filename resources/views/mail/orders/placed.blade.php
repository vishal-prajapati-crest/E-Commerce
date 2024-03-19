<div>
    <p>Hello there,</p>
    <p>Your order (ID: {{ $orderDetail->id }}) has been placed successfully. Here are the details:</p>
    <table>

        <tbody>
            <tr>
                <td colspan="5" style="text-align: right; font-weight: bold;">Total Amount</td>
                <td>${{ $orderDetail->total_amount }}</td>
            </tr>
        </tbody>
    </table>
    <p>Thank you for shopping with Ecommerce!</p>
</div>
