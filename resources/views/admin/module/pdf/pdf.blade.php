<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task report View  PDF</title>
    <style>
        * {
            margin: 0;
        }

        @page {
            margin-top: 100px !important;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 100%;
            height: auto;

        }

        /* header start */
        header {
            position: fixed;
            left: 30;
            right: 30;
            height: 150px;
            margin-top: -110px;
        }

        table.header {
            width: 100%;
            border-collapse: collapse;
        }

        table.header tr th img.company-logo {
            width: 50%;
            object-fit: cover;
        }

        table.header tr th:nth-child(2),
        table.header tr th:nth-child(3) {
            padding-top: 1.2rem;
        }

        .stock-number {
            font-size: 20px;
            font-weight: 100;
            margin-left: 1%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .customer-name {
            text-align: right;
            opacity: 0;
        }

        table.content {
            width: 100%;

            border-collapse: collapse;
            font-size: 0.85rem;
            border-bottom: none !important;
        }

        table.content,
        table.content tr td,
        table.content tr th {
            border: 0.05rem solid black;
        }

        table.content,
        table.content tr th:first-child {
            border-left: none;
        }

        table.content,
        table.content tr th:last-child {
            border-right: none;
        }

        table.content tbody tr,
        table.content tbody tr th {

            border-bottom: none;
            border-top: none;

        }

        .content-row-height {

            line-height: 18.25px;
            font-family: Arial, Helvetica, sans-serif;



        }

        .content-row-border-bottom {
            border-bottom: 0.05rem solid black !important;
        }

        .word-inline {
            white-space: nowrap;
            /* Prevent wrapping */
            overflow: hidden;
            /* Hide overflow if content is too wide */
            text-overflow: ellipsis;
            /* Add ellipsis (...) if content overflows */
        }

        .text-white {
            color: white;
        }


        /* content end */

        /* footer start */
        footer {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 115px;
            bottom: 0px;
            margin-bottom: -110px;
        }

        table.footer,
        table.footer tr th {
            border: none
        }

        table.footer tr th {
            padding-bottom: 40px;
        }

        table.footer tr th:nth-child(2) {
            vertical-align: top;
            text-align: center;
            border: 1px solid black;

        }

        .page-no-tr {

            border-left: none;
            border-right: none;
            border-bottom: none;

        }

        .page-no-th .page-no-main-div {

            margin-top: 27px !important;
            padding-bottom: 10px !important;

        }

        .page-number {
            font-size: 1rem;
            font-weight: 700
        }

        .page-number-count:before {
            content: counter(page);
            font-size: 2rem;
        }

        .signature {
            vertical-align: top;
            border-bottom: 1px solid black !important;
        }

        .signature div {
            margin-top: 10px
        }

        .border-enable {
            border: 1px solid black !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .border-bottom-hide {
            border-bottom: none !important;
        }

        .border-top-hide {
            border-top: none !important;
        }

        .row {
            display: table;
            width: 100%;
            border-spacing: 10px;
        }

        .col-after_device_id {
            display: table-cell;
            width: 33.3333%;
            padding: 10px;
        }

        .header_after_device {
            font-size: 10px;
        }

        .device-info {
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .Log_Interval {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .summary-section,
        .alarm-section {
            margin-top: 20px;
        }

        .summary-section h2,
        .alarm-section h2 {
            font-size: 14px;
            font-weight: 500;
        }

        .summary-section table,
        .alarm-section table {
            width: 100%;
            margin-top: 10px;
        }

        .summary-section table td,
        .alarm-section table td {
            padding: 5px 0;
        }

        .summary-section table td:first-child,
        .alarm-section table td:first-child {
            width: 60%;
        }

        .summary-section table td:last-child,
        .alarm-section table td:last-child {
            text-align: left;
        }



        /* footer end */
    </style>
</head>

<body>

    <header>
        <table width="100%" class="header">
            <tr>
                <th width="17%">
                    <img src="{{ public_path('images/pdf.png') }}" class="company-logo" style="margin-top: 10px"
                        alt="company-logo">
                </th>
                <th width="60%">
                    <div class="stock-number">
                        Task REPORT
                    </div>
                </th>
                <th width="19%" style="opacity: 0">
                    <img src="{{ public_path('images/pdf.png') }}" class="company-logo" alt="company-logo">
                </th>
            </tr>
        </table>
    </header>

    <main style="margin-left: 40px; margin-right:40px; margin-top:40px;">
       
        <table style="border: 1px solid; border-collapse: collapse; width: 100%;">
            <thead>
                <tr role="row">
                    <th style="border: 1px solid;">Project</th>
                    <th style="border: 1px solid;">Task</th>
                    <th style="border: 1px solid;">Description</th>
                    <th style="border: 1px solid;">Duedate</th>
                    <th style="border: 1px solid;">Creater</th>
                    <th style="border: 1px solid;">Assigner</th>
                    <th style="border: 1px solid;">Status</th>
                    <th style="border: 1px solid;">Priority</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr role="row" class="odd">
                        <td style="border: 1px solid;">{{ $task->project->name }}</td>
                        <td style="border: 1px solid;">{{ $task->name }}</td>
                        <td style="border: 1px solid;">{{ $task->description }}</td>
                        <td style="border: 1px solid;">{{ $task->due_date }}</td>
                        <td style="border: 1px solid;">{{ $task->creator->name }}</td>
                        <td style="border: 1px solid;">{{ $task->assignee->name }}</td>
                        <td style="border: 1px solid;">{{ $task->status }}</td>
                        <td style="border: 1px solid;">{{ $task->priority }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        
    </main>


</body>

</html>
