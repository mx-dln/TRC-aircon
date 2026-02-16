<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation {{ $quotation->quotation_no }}</title>

    <style>
        @page { margin: 30px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            height: 150px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
            padding: 6px;
        }

        .label {
            background: #0b6fa4;
            color: #fff;
            font-weight: bold;
            width: 18%;
        }

        .label-right {
            background: #0b6fa4;
            color: #fff;
            font-weight: bold;
            width: 20%;
        }

        .items th {
            background: #0b6fa4;
            color: #fff;
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .no-border {
            border: none;
        }

        .total-label {
            background: #0b6fa4;
            color: #fff;
            font-weight: bold;
        }

        .note {
            font-style: italic;
            text-align: right;
            margin-top: 5px;
        }

        .footer {
            margin-top: 20px;
        }

        .signature {
            margin-top: 40px;
        }
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <img src="{{ public_path('images/tcr-logo-transparent.png') }}">
</div>

{{-- PROJECT INFO --}}
<table>
    <tr>
        <td class="label">Project Name</td>
        <td>{{ $quotation->project_name }}</td>

        <td class="label-right">Contact No.</td>
        <td>{{ $quotation->contact_no }}</td>
    </tr>

    <tr>
        <td class="label">Address</td>
        <td>{{ $quotation->address }}</td>

        <td class="label-right">Contact Person</td>
        <td>{{ $quotation->contact_person }}</td>
    </tr>

    <tr>
        <td class="label">Email Address</td>
        <td>{{ $quotation->email }}</td>

        <td class="label-right">Quotation Form #</td>
        <td>{{ $quotation->quotation_no }}</td>
    </tr>
</table>

<br>

<p>
    Dear Ma'am/Sir,<br><br>
    We are pleased to submit to you the price of our following services request for your requirements:
</p>

{{-- ITEMS --}}
<table class="items">
    <thead>
        <tr>
            <th>Item Description</th>
            <th width="7%">Qty</th>
            <th width="8%">Unit</th>
            <th width="15%">Price</th>
            <th width="15%">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quotation->items as $item)
            <tr>
                <td>
                    {{ $item->product->type->name }} -
                    {{ $item->product->brand->name }}
                    ({{ $item->product->capacity }})
                </td>
                <td class="center">{{ $item->quantity }}</td>
                <td class="center">{{ $item->unit }}</td>
                <td class="right">Php{{ number_format($item->unit_price, 2) }}</td>
                <td class="right">
                    Php{{ number_format($item->quantity * $item->unit_price, 2) }}
                </td>
            </tr>
        @endforeach
    </tbody>

    {{-- TOTALS --}}
    <tfoot>
        <tr>
            <td colspan="4" class="right"><strong>SUB-TOTAL:</strong></td>
            <td class="right"><strong>Php{{ number_format($quotation->total_amount, 2) }}</strong></td>
        </tr>
        <tr>
            <td colspan="4" class="total-label right">GRAND TOTAL</td>
            <td class="total-label right">
                Php{{ number_format($quotation->total_amount, 2) }}
            </td>
        </tr>
    </tfoot>
</table>

<div class="note">
    *ACKNOWLEDGEMENT RECEIPT ONLY
</div>

{{-- TERMS --}}
<div class="footer">
    <table class="no-border">
        <tr>
            <td class="no-border"><strong>Availability:</strong></td>
            <td class="no-border">Units on stock as of {{ now()->format('F j, Y') }}, delivery 1–2 days after full payment</td>
        </tr>
        <tr>
            <td class="no-border"><strong>Validity:</strong></td>
            <td class="no-border">Quotation only valid for 7 days upon issuance</td>
        </tr>
        <tr>
            <td class="no-border"><strong>Terms of Payment:</strong></td>
            <td class="no-border">100% full payment before delivery</td>
        </tr>
        <tr>
            <td class="no-border"><strong>Mode of Payment:</strong></td>
            <td class="no-border">
                For Check payment, please make payable to
                <strong>TCR MECHANICAL AND AIR CONDITIONING SOLUTIONS INC.</strong><br>
                BDO Checking Account: 0045-8801-9169
            </td>
        </tr>
        <tr>
            <td class="no-border"><strong>Inclusions:</strong></td>
            <td class="no-border">Delivery Receipt</td>
        </tr>
    </table>
</div>

{{-- SIGNATURES --}}
<div class="signature">
    <table class="no-border">
        <tr>
            <td class="no-border">
                Prepared By:<br><br><br>
                <strong>Engr. David Antejohn Cope</strong><br>
                <em>Mechanical Engineer</em><br>
                9323671761<br>
                tcr.airconditioning@gmail.com
            </td>

            <td class="no-border center">
                Conforme:<br><br><br>
                _______________________________<br>
                Customer Signature over printed name
            </td>
        </tr>
    </table>

    <br>
    Date: {{ now()->format('j-M-Y') }}
</div>

</body>
</html>
