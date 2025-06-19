@extends('layouts.theme')

@section('content')
<style>
    .tier-green { background-color: #d4edda; }
    .tier-blue { background-color: #d1ecf1; }
    .tier-purple { background-color: #e2d6f3; }
    .tier-gold { background-color: #FFCC99; }
    .tier-red { background-color: #FA8072; }
</style>

<div class="row">
    <div class="mt-3">
        <label>
            <div style="font-size: 1.2rem; font-weight: bold;">
                Total Score SVS : <span id="total_score" style="font-size: 1.8rem;">0</span>
            </div>
        </label>
    </div>

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

    <center><hr></center>

    {{-- ปุ่มเพิ่มและลบ อยู่ข้างกัน --}}
    <div class="col-12 text-right d-flex justify-content-end gap-2">
        <button type="button" id="delete-select-btn" class="btn btn-danger" style="min-width: 90px; display:none;">- Delete</button>
        <button type="button" id="add-select-btn" class="btn btn-primary" style="min-width: 90px;">+ Add</button>
    </div>

    {{-- ชุด Select เริ่มต้น --}}
    <div class="col-12 mt-2" id="select-container">
        <div class="row select-row">
            <div class="col-md-6">
                <label><b>Starting Point</b></label>
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
                <label><b>End Point</b></label>
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
            <div class="row mt-2 per-result">
                <div class="col-12 text-muted small">
                    <span class="res-summary" style="float: right;">Alloy: - | Solution: - | Plans: - | Amber: - | Score SVS: -</span>
                </div>
            </div>
            <!-- <center><hr></center> -->
        </div>
    </div>

    {{-- ผลรวมทรัพยากร --}}
    <div class="col-12 mt-3 mb-4">
        <div class="row text-center font-weight-bold">
            <div class="col-3">
                <div>Hardened Alloy</div>
                <b><span id="total_alloy">0</span></b>
            </div>
            <div class="col-3">
                <div>Polishing Solution</div>
                <b><span id="total_solution">0</span></b>
            </div>
            <div class="col-3">
                <div>Design Plans</div>
                <b><span id="total_plans">0</span></b>
            </div>
            <div class="col-3">
                <div>Lunar Amber</div>
                <b><span id="total_amber">0</span></b>
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
                    <th scope="col">Score (SVS)</th>
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
                        } elseif (in_array($item->Tier, ['Red', 'Red T1', 'Red T2', 'Red T3'])) {
                            $tierClass = 'tier-red';
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
                        <td>{{ is_numeric($item->Score) ? number_format($item->Score) : '-' }}</td>
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
        let totalScore = 0;

        container.querySelectorAll('.select-row').forEach(row => {
            const start = parseInt(row.querySelector('.start_select').value);
            const end = parseInt(row.querySelector('.end_select').value);
            const resultSpan = row.querySelector('.res-summary');

            if (isNaN(start) || isNaN(end)) {
                if (resultSpan) resultSpan.textContent = 'Alloy: - | Solution: - | Plans: - | Amber: - | Score SVS: -';
                return;
            }

            let from = Math.min(start, end);
            let to = Math.max(start, end);
            from = start < end ? from + 1 : from;
            to = start > end ? to - 1 : to;

            let stepAlloy = 0, stepSolution = 0, stepPlans = 0, stepAmber = 0, scoreStep = 0;

            for (let i = from; i <= to; i++) {
                const item = tiersData[i];
                stepAlloy += parseInt(item.Hardened_Alloy) || 0;
                stepSolution += parseInt(item.Polishing_Solution) || 0;
                stepPlans += parseInt(item.Design_Plans) || 0;
                stepAmber += parseInt(item.Lunar_Amber) || 0;
                scoreStep += parseInt(item.Score) || 0;
            }

            alloy += stepAlloy;
            solution += stepSolution;
            plans += stepPlans;
            amber += stepAmber;
            totalScore += scoreStep * 36;

            // แสดงผลเฉพาะชุดนี้
            if (resultSpan) {
                resultSpan.textContent = `Alloy: ${stepAlloy.toLocaleString()} | Solution: ${stepSolution.toLocaleString()} | Plans: ${stepPlans.toLocaleString()} | Amber: ${stepAmber.toLocaleString()} | Score SVS: ${(scoreStep * 36).toLocaleString()}`;
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

        const scoreEl = document.getElementById('total_score');
        if (scoreEl) {
            scoreEl.textContent = totalScore.toLocaleString();
        }

        saveToLocalStorage(); // บันทึกค่าทุกครั้งหลังคำนวณ
    }



    function updateDisplay(id, total, have) {
        const el = document.getElementById(id);
        const diff = have - total;
        const color = diff >= 0 ? 'green' : 'red';
        const statusText = diff >= 0 ? ` (+${diff.toLocaleString()})` : ` (${diff.toLocaleString()})`;

        el.innerHTML = `
            <span style="color:${color}; font-size: 1rem;">${total.toLocaleString()}</span> 
            <span style="color:black; font-size: 0.85rem;">(${have.toLocaleString()})</span>
            <br>
            <span style="color:${color}; font-size: 0.85rem; font-weight: bold;">${statusText}</span>
        `;
    }


    function updateButtonsVisibility() {
        const count = container.querySelectorAll('.select-row').length;
        addBtn.style.display = count >= maxSelects ? 'none' : '';
        deleteBtn.style.display = count > 1 ? '' : 'none';
    }

    

    window.addEventListener('DOMContentLoaded', () => {
        loadFromLocalStorage(); // โหลดก่อนคำนวณ
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

    // บันทึกข้อมูลลง localStorage
    function saveToLocalStorage() {
        const inputs = {
            user_alloy: document.getElementById('user_alloy').value,
            user_solution: document.getElementById('user_solution').value,
            user_plans: document.getElementById('user_plans').value,
            user_amber: document.getElementById('user_amber').value,
            selects: []
        };

        container.querySelectorAll('.select-row').forEach(row => {
            inputs.selects.push({
                start: row.querySelector('.start_select').value,
                end: row.querySelector('.end_select').value
            });
        });

        localStorage.setItem('gear_data', JSON.stringify(inputs));
    }

    // โหลดข้อมูลจาก localStorage
    function loadFromLocalStorage() {
        const data = localStorage.getItem('gear_data');
        if (!data) return;

        const parsed = JSON.parse(data);

        document.getElementById('user_alloy').value = parsed.user_alloy || '';
        document.getElementById('user_solution').value = parsed.user_solution || '';
        document.getElementById('user_plans').value = parsed.user_plans || '';
        document.getElementById('user_amber').value = parsed.user_amber || '';

        // ลบ select-row เก่า (เว้นแถวแรกไว้)
        const rows = container.querySelectorAll('.select-row');
        rows.forEach((row, index) => {
            if (index > 0) row.remove();
        });

        // โหลดค่า select
        parsed.selects.forEach((set, i) => {
            if (i > 0) {
                const template = container.querySelector('.select-row').cloneNode(true);
                template.querySelector('.start_select').value = '';
                template.querySelector('.end_select').value = '';
                template.querySelector('.end_select').disabled = true;
                template.classList.add('mt-2');
                container.appendChild(template);
                attachListeners(template);
            }

            const row = container.querySelectorAll('.select-row')[i];
            row.querySelector('.start_select').value = set.start || '';
            if (set.start) row.querySelector('.end_select').disabled = false;
            row.querySelector('.end_select').value = set.end || '';
        });
    }


</script>
@endsection
