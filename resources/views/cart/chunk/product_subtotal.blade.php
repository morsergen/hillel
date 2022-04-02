<tr>
    <td colspan="3"></td>
    <td>Subtotal</td>
    <td colspan="2"><?php echo \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal(); ?></td>
</tr>
<tr>
    <td colspan="3"></td>
    <td>Tax</td>
    <td colspan="2"><?php echo \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->tax(); ?></td>
</tr>
<tr>
    <td colspan="3"></td>
    <td>Total</td>
    <td colspan="2"><?php echo \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->total(); ?></td>
</tr>
