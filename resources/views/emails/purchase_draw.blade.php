<p>Dear {{ $purchase['user']->first_name . ' ' . $purchase['user']->last_name }},</p>
<br>
<p>Thank you for paying the delivery for {{ $purchase['item_name'] }}.</p>
<p>Invoice No: {{ $purchase['invoice_id'] }}.</p>
<br>
<p>You may claim your prize or it can be sent to your registered delivery address below</p>
<br>
Registered Delivery Address: <b> {{ $purchase['address'] }} </b>
<br>
<br>
<p>Thank you,</p>
<p>Hoseh</p>
