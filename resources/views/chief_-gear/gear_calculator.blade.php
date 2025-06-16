@extends('layouts.theme')

@section('content')
<style>
    .tier-green { background-color: #d4edda; }
    .tier-blue { background-color: #d1ecf1; }
    .tier-purple { background-color: #e2d6f3; }
    .tier-gold { background-color: #FFCC99; }
    .tier-pink { background-color: #FA8072; }
</style>

<div class="row">

    {{-- Input ผู้ใช้มีทรัพยากร --}}
    <div class="col-12 mt-3">
        <div class="row text-center font-weight-bold">
            <div class="col-3">
                Hardened Alloy
                <input type="number" id="user_alloy" class="form-control" value="0" min="0">
            </div>
            <div class="col-3">
                Polishing Solution
                <input type="number" id="user_solution" class="form-control" value="0" min="0">
            </div>
            <div class="col-3">
                Design Plans
                <input type="number" id="user_plans" class="form-control" value="0" min="0">
            </div>
            <div class="col-3">
                Lunar Amber
                <input type="number" id="user_amber" class="form-control" value="0" min="0">
            </div>
        </div>
    </div>

    {{-- ชุด Select เริ่มต้น --}}
    <div class="col-12 mt-4" id="select-container">
        <div class="row select-row">
            <div class="col-md-6">
                <label>Starting Point:</label>
                <select class="form-control start_select">
                    <option value="">-- Please select --</option>
                    @foreach($tiersWithStars as $i => $item)
                        <option value="{{ $i }}">
                            {{ $item->Tier }}
                            @if($item->Stars > 0)
                                - {!! str_repeat('&#9733;', $item->Stars) !!}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>End Point:</label>
                <select class="form-control end_select" disabled>
                    <option value="">-- Please select --</option>
                    @foreach($tiersWithStars as $i => $item)
                        <option value="{{ $i }}">
                            {{ $item->Tier }}
                            @if($item->Stars > 0)
                                - {!! str_repeat('&#9733;', $item->Stars) !!}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- ปุ่มเพิ่มและลบ อยู่ข้างกัน --}}
    <div class="col-12 text-right mt-2 mb-3 d-flex justify-content-end gap-2">
        <button type="button" id="delete-select-btn" class="btn btn-danger" style="min-width: 90px; display:none;">- Delete</button>
        <button type="button" id="add-select-btn" class="btn btn-primary" style="min-width: 90px;">+ Add</button>
    </div>

    {{-- ผลรวมทรัพยากร --}}
    <div class="col-12 mt-3 mb-4">
        <div class="row text-center font-weight-bold">
            <div class="col-3">
                Hardened Alloy
                <br><b><span id="total_alloy">0</span></b>
            </div>
            <div class="col-3">
                Polishing Solution
                <br><b><span id="total_solution">0</span></b>
            </div>
            <div class="col-3">
                Design Plans
                <br><b><span id="total_plans">0</span></b>
            </div>
            <div class="col-3">
                Lunar Amber
                <br><b><span id="total_amber">0</span></b>
            </div>
        </div>
    </div>

    <hr>

    {{-- ตารางข้อมูลทั้งหมด --}}
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
                    <th scope="col">Power</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tiersWithStars as $item)
                    @php
                        if ($item->Tier === 'Green') {
                            $tierClass = 'tier-green';
                        } elseif ($item->Tier === 'Blue') {
                            $tierClass = 'tier-blue';
                        } elseif (in_array($item->Tier, ['Purple', 'Purple T1'])) {
                            $tierClass = 'tier-purple';
                        } elseif (in_array($item->Tier, ['Gold', 'Gold T1', 'Gold T2'])) {
                            $tierClass = 'tier-gold';
                        } elseif (in_array($item->Tier, ['Pink', 'Pink T1', 'Pink T2', 'Pink T3'])) {
                            $tierClass = 'tier-pink';
                        } else {
                            $tierClass = '';
                        }
                    @endphp

                    <tr class="{{ $tierClass }}">
                        <td>{{ $item->Tier }}</td>
                        <td>
                            @if($item->Stars > 0)
                                {!! str_repeat('&#9733;', $item->Stars) !!}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ is_numeric($item->Hardened_Alloy) ? number_format($item->Hardened_Alloy) : '-' }}</td>
                        <td>{{ is_numeric($item->Polishing_Solution) ? number_format($item->Polishing_Solution) : '-' }}</td>
                        <td>{{ is_numeric($item->Design_Plans) ? number_format($item->Design_Plans) : '-' }}</td>
                        <td>{{ is_numeric($item->Lunar_Amber) ? number_format($item->Lunar_Amber) : '-' }}</td>
                        <td>{{ is_numeric($item->Power) ? number_format($item->Power) : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    const tiersData = @json($tiersWithStars);
    let maxSelects = 6;

    const container = document.getElementById('select-container');
    const addBtn = document.getElementById('add-select-btn');
    const deleteBtn = document.getElementById('delete-select-btn');

    addBtn.addEventListener('click', () => {
        const current = container.querySelectorAll('.select-row').length;
        if (current >= maxSelects) return;

        const template = container.querySelector('.select-row').cloneNode(true);
        template.querySelector('.start_select').value = "";
        template.querySelector('.end_select').value = "";
        template.querySelector('.end_select').disabled = true;
        template.classList.add('mt-2');

        container.appendChild(template);
        attachListeners(template);
        calculateResources();
        updateButtonsVisibility();
    });

    deleteBtn.addEventListener('click', () => {
        const rows = container.querySelectorAll('.select-row');
        if (rows.length > 1) {
            rows[rows.length - 1].remove();
            calculateResources();
            updateButtonsVisibility();
        }
    });

    function attachListeners(row) {
        const start = row.querySelector('.start_select');
        const end = row.querySelector('.end_select');

        start.addEventListener('change', () => {
            const sIdx = parseInt(start.value);
            if (isNaN(sIdx)) {
                end.disabled = true;
                end.value = "";
                calculateResources();
                return;
            }
            end.disabled = false;
            Array.from(end.options).forEach((opt, i) => {
                if (i === 0) return;
                opt.disabled = parseInt(opt.value) <= sIdx;
            });
            if (parseInt(end.value) <= sIdx) {
                end.value = "";
            }
            calculateResources();
        });

        end.addEventListener('change', calculateResources);
    }

    document.querySelectorAll('.select-row').forEach(attachListeners);

    document.querySelectorAll('#user_alloy, #user_solution, #user_plans, #user_amber')
        .forEach(input => input.addEventListener('input', calculateResources));

    function calculateResources() {
        let alloy = 0, solution = 0, plans = 0, amber = 0;

        container.querySelectorAll('.select-row').forEach(row => {
            const start = parseInt(row.querySelector('.start_select').value);
            const end = parseInt(row.querySelector('.end_select').value);
            if (isNaN(start) || isNaN(end)) return;

            let from = Math.min(start, end);
            let to = Math.max(start, end);
            from = start < end ? from + 1 : from;
            to = start > end ? to - 1 : to;

            for (let i = from; i <= to; i++) {
                const item = tiersData[i];
                alloy += parseInt(item.Hardened_Alloy) || 0;
                solution += parseInt(item.Polishing_Solution) || 0;
                plans += parseInt(item.Design_Plans) || 0;
                amber += parseInt(item.Lunar_Amber) || 0;
            }
        });

        const userAlloy = parseInt(document.getElementById('user_alloy').value) || 0;
        const userSolution = parseInt(document.getElementById('user_solution').value) || 0;
        const userPlans = parseInt(document.getElementById('user_plans').value) || 0;
        const userAmber = parseInt(document.getElementById('user_amber').value) || 0;

        updateDisplay('total_alloy', alloy, userAlloy);
        updateDisplay('total_solution', solution, userSolution);
        updateDisplay('total_plans', plans, userPlans);
        updateDisplay('total_amber', amber, userAmber);
    }

    function updateDisplay(id, total, have) {
        const el = document.getElementById(id);
        el.innerHTML = `<span style="color:${have >= total ? 'green' : 'red'};">${total.toLocaleString()}</span> <span style="color:black;">(${have.toLocaleString()})</span>`;
    }

    function updateButtonsVisibility() {
        const count = container.querySelectorAll('.select-row').length;
        addBtn.style.display = count >= maxSelects ? 'none' : '';
        deleteBtn.style.display = count > 1 ? '' : 'none';
    }

    // เรียกตอนโหลดหน้าครั้งแรก
    window.addEventListener('DOMContentLoaded', () => {
        calculateResources();
        updateButtonsVisibility();
    });

    document.querySelectorAll('#user_alloy, #user_solution, #user_plans, #user_amber').forEach(input => {
        input.addEventListener('focus', () => {
            if (input.value === '0') {
                input.value = '';
            }
        });
    });


</script>
@endsection
