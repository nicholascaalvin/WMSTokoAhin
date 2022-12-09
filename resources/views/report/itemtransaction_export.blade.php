<style>
    table, th, td{
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<table width='100%' style='font-size:12px'>
    <thead>
        <tr>
            <?php
            echo "<th>Item Name</th>";
            echo "<th>Date</th>";
            echo "<th>Type</th>";
            echo "<th>Aisle</th>";
            echo "<th>Qty</th>";
            ?>
        </tr>
    </thead>
    <tbody>
        @if (count($query->get()) == 0)
            <tr style='background-color: #ffe4ca;'>
                <td colspan='{{ count($query->get()) + 1 }}' style="text-align:center">No Data Avaliable</td>
            </tr>
        @else
            @foreach ($query->get() as $row)
                <tr>
                    <?php
                    echo "<td>$row->name</td>";
                    echo "<td>$row->transaction_date</td>";
                    echo "<td>$row->type</td>";
                    echo "<td>$row->aisle_name</td>";
                    echo "<td>$row->qty</td>";
                    ?>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

