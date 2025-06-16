@extends('layouts.theme')

@section('content')
<style>
    .tier-green { background-color: #d4edda; }     /* เขียวอ่อน */
    .tier-blue { background-color: #d1ecf1; }      /* ฟ้าอ่อน */
    .tier-purple { background-color: #e2d6f3; }    /* ม่วงอ่อน */
    .tier-gold { background-color: #FF9966cc; }      /* เหลืองทอง */
    .tier-pink { background-color: #FF3333cc; }      /* ชมพูอ่อน */
</style>


<div class="row">
    <div class="col-12 mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="start_select">Select starting point:</label>
                <select id="start_select" class="form-control">
                    <option value="">-- Please select --</option>
                    @foreach($tiersWithStars as $index => $item)
                        <option value="{{ $index }}">{{ $item->Tier }} - {{ $item->Stars }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="end_select">Select end point:</label>
                <select id="end_select" class="form-control">
                    <option value="">-- Please select --</option>
                    @foreach($tiersWithStars as $index => $item)
                        <option value="{{ $index }}">{{ $item->Tier }} - {{ $item->Stars }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4 mb-3">
        <div class="row text-center">
            <div class="col-3">
                Hardened Alloy
                <br>
                <span id="total_alloy"><b>0</b></span>
            </div>
            <div class="col-3">
                Polishing Solution
                <br>
                <span id="total_solution"><b>0</b></span>
            </div>
            <div class="col-3">
                Design Plans
                <br>
                <span id="total_plans"><b>0</b></span>
            </div>
            <div class="col-3">
                Lunar Amber
                <br>
                <span id="total_amber"><b>0</b></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-12" style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tier</th>
                    <th scope="col">Stars</th>
                    <th scope="col">Hardened Alloy</th>
                    <th scope="col">Polishing Solution</th>
                    <th scope="col">Design Plans</th>
                    <th scope="col">Lunar Amber</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tiersWithStars as $item)
                    @php
                        $tierClass = '';
                        switch($item->Tier) {
                            case 'Green': $tierClass = 'tier-green'; break;
                            case 'Blue': $tierClass = 'tier-blue'; break;
                            case 'Purple': $tierClass = 'tier-purple'; break;
                            case 'Purple T1': $tierClass = 'tier-purple'; break;
                            case 'Gold': $tierClass = 'tier-gold'; break;
                            case 'Gold T1': $tierClass = 'tier-gold'; break;
                            case 'Gold T2': $tierClass = 'tier-gold'; break;
                            case 'Pink': $tierClass = 'tier-pink'; break;
                            case 'Pink T1': $tierClass = 'tier-pink'; break;
                            case 'Pink T2': $tierClass = 'tier-pink'; break;
                            case 'Pink T3': $tierClass = 'tier-pink'; break;
                        }
                    @endphp
                    <tr class="{{ $tierClass }}">
                        <td>{{ $item->Tier }}</td>
                        <td>{{ $item->Stars }}</td>
                        <td>{{ is_numeric($item->Hardened_Alloy) ? number_format((float) $item->Hardened_Alloy) : '-' }}</td>
                        <td>{{ is_numeric($item->Polishing_Solution) ? number_format((float) $item->Polishing_Solution) : '-' }}</td>
                        <td>{{ is_numeric($item->Design_Plans) ? number_format((float) $item->Design_Plans) : '-' }}</td>
                        <td>{{ is_numeric($item->Lunar_Amber) ? number_format((float) $item->Lunar_Amber) : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>

    const startSelect = document.getElementById('start_select');
    const endSelect = document.getElementById('end_select');

    startSelect.addEventListener('change', function () {
        const startIndex = parseInt(startSelect.value);

        if (isNaN(startIndex)) {
            endSelect.disabled = true;
            endSelect.value = "";
            return;
        }

        endSelect.disabled = false;

        Array.from(endSelect.options).forEach((option, index) => {
            if (index === 0) return;
            const optionValue = parseInt(option.value);
            option.disabled = optionValue <= startIndex;
        });

        if (parseInt(endSelect.value) <= startIndex) {
            endSelect.value = "";
        }
        calculateResources();
    });

    endSelect.addEventListener('change', calculateResources);

    window.addEventListener('DOMContentLoaded', () => {
        endSelect.disabled = true;
    });

    const tiersData = @json($tiersWithStars);

    function calculateResources() {
        const start = parseInt(startSelect.value);
        const end = parseInt(endSelect.value);

        if (isNaN(start) || isNaN(end)) {
            // เคลียร์ผลรวมถ้าค่าผิดพลาด
            document.getElementById('total_alloy').textContent = '0';
            document.getElementById('total_solution').textContent = '0';
            document.getElementById('total_plans').textContent = '0';
            document.getElementById('total_amber').textContent = '0';
            return;
        }

        let from = Math.min(start, end);
        let to = Math.max(start, end);

        // ข้ามจุดเริ่มต้น
        if (start < end) {
            from += 1;
        } else if (start > end) {
            to -= 1;
        } else {
            from = to + 1;
        }

        let totalAlloy = 0, totalSolution = 0, totalPlans = 0, totalAmber = 0;

        for (let i = from; i <= to; i++) {
            const item = tiersData[i];
            totalAlloy += parseInt(item.Hardened_Alloy) || 0;
            totalSolution += parseInt(item.Polishing_Solution) || 0;
            totalPlans += parseInt(item.Design_Plans) || 0;
            totalAmber += parseInt(item.Lunar_Amber) || 0;
        }

        document.getElementById('total_alloy').textContent = totalAlloy.toLocaleString();
        document.getElementById('total_solution').textContent = totalSolution.toLocaleString();
        document.getElementById('total_plans').textContent = totalPlans.toLocaleString();
        document.getElementById('total_amber').textContent = totalAmber.toLocaleString();
    }

</script>

@endsection
