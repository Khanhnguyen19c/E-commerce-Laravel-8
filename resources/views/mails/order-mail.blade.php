<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Xác Nhận Đơn Hàng</title>
</head>
<body>
    <p>Hi {{$order->firstname}} {{$order->lastname}}</p>
    <p>Bạn đã đặt hàng thành công tại Website của chúng tôi!</p>
    <br>
    <table style="width: 600px; text-align:right;">
    <thead>
    <tr>
            <th>Hình Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số Lượng</th>
            <th>Tạm Tính</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
            <tr>
                <td><img src="{{asset('assets/images/products')}}/{{$item->product->image}}" width="100"></td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{number_format($item->price * $item->quantity,0,',',',')}}đ</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="border-top:1px solid #ccc"></td>
                <td style="font-size: 15px;font-weight:bold;border-top:1px solid #ccc">Tổng cộng: {{number_format($order->subtotal,0,',',',')}}đ</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size: 15px;font-weight:bold;">Thuế: {{number_format($order->tax,0,',',',')}}đ</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size: 15px;font-weight:bold;">Free Shipping</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size: 15px;font-weight:bold;">Thành tiền: {{number_format($order->total,0,',',',')}}đ</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
