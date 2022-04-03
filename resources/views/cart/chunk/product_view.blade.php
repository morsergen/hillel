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
    <td>
        <form action="{{ route('cart.update', $row->model) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" value="<?php echo $row->rowId; ?>" name="row_id">
            <input type="number" name="product_count" value="<?php echo $row->qty; ?>" min="1" max="{{ $row->model->in_stock }}" />
            <input type="submit" class="btn btn-outline-success" value="Update count">
        </form>
    </td>
    <td><?php echo $row->price; ?></td>
    <td><?php echo $row->total; ?></td>
    <td>
        <form action="{{ route('cart.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" value="<?php echo $row->rowId; ?>" name="row_id">
            <input type="submit" class="btn btn-outline-danger" value="x">
        </form>
    </td>
</tr>
