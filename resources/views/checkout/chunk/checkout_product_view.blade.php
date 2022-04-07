<tr>
    <td>
        <p><img src="{{ asset('storage/' . $row->model->thumbnail) }}" width="75" /></p>
    </td>
    <td>
        <p>
            <a href="{{ route('products.show', $row->model) }}">
                <strong><?php echo $row->name; ?></strong>
            </a>
        </p>
        {{--        <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>--}}
    </td>
    <td><?php echo $row->qty; ?></td>
    <td><?php echo $row->price; ?></td>
    <td><?php echo $row->subtotal; ?></td>
</tr>
