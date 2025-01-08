@extends('admin.master_layout')

@section('page_content')
<div class="container">
    <h3>Biểu đồ thống kê sách</h3>
    
    <!-- Biểu đồ cột -->
    <canvas id="salse-revenue" width="400" height="200"></canvas>
    
    <p>Đang chờ xét duyệt: {{ $borrow }}</p>
    <a href="{{route('list_borrowing')}}" class="btn btn-primary">Xem</a>
    
    <p>Đang mượn: {{ $borrowed }}</p>
    <a href="{{route('borrowing')}}" class="btn btn-info">Xem</a>
    
    <p>Đã trả: {{ $returned }}</p>
    <a href="{{ route('borrows.returned') }}" class="btn btn-success">Xem</a>
    
    <p>Đơn huỷ: {{ $deleted }}</p>
    <a href="{{ route('borrow.delete') }}" class="btn btn-danger">Xem</a>
    
    <p>Tổng: {{ $totalBorrowed }}</p>
    
    <!-- Biểu đồ tròn thống kê theo tuần -->
    <h3>Thống kê sách theo tuần</h3>
    <canvas id="weekly-statistics" width="400" height="200"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxBar = document.getElementById('salse-revenue').getContext('2d');
        if (!ctxBar) {
            console.error('Không thể lấy context 2D của canvas!');
            return;
        }
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Đang chờ xét duyệt', 'Đã mượn xong', 'Đã trả', 'Đã xóa'],
                datasets: [{
                    label: 'Thống kê sách',
                    data: [{{ $borrow }}, {{ $borrowed }}, {{ $returned }}, {{ $deleted }}],
                    backgroundColor: ['#4BC0C0', '#36A2EB', '#FFCE56', '#FF6384'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Biểu đồ tròn thống kê trong tuần
        const ctxPie = document.getElementById('weekly-statistics').getContext('2d');
        if (!ctxPie) {
            console.error('Không thể lấy context 2D của canvas!');
            return;
        }
        const pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Đang chờ xét duyệt', 'Đã mượn', 'Đã trả', 'Đơn huỷ'],
                datasets: [{
                    data: [{{ $borrow }}, {{ $borrowed }}, {{ $returned }}, {{ $deleted }}],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                    borderWidth: 1
                }]
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .btn {
        padding: 6px 12px;
        margin: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        border-radius: 4px;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-info {
        background-color: #17a2b8;
        color: white;
    }
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    .btn:hover {
        opacity: 0.8;
        text-decoration: none;
    }
</style>
@endpush
