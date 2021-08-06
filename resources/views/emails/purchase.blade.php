<p>Dear {{ $purchase['user']->first_name . ' ' . $purchase['user']->last_name }},</p>
<br>
<p>{{ $purchase['token_pack'] }}.</p>
<p>Invoice No: {{ $purchase['invoice_id'] }}.</p>
<br>
<p>You may now use your tokens for joining any lucky draws and bids.</p>
<br>
<p>Thank you,</p>
<p>Hoseh</p>
