@extends('layouts.app')
@section('content')
<style>
   .chart-wrapper {
   height: 260px;
   }
   .chart-wrapper canvas {
   max-height: 100% !important;
   }
</style>
<div class="container mt-4">
   <h2>Data Warehouse Summary</h2>
   <hr>
   <div class="row mb-4">
      <div class="col-md-4">
         <div class="p-3 bg-primary text-white rounded shadow-sm">
            <h5>Students</h5>
            <h3>{{ $studentCount }}</h3>
         </div>
      </div>
      <div class="col-md-4">
         <div class="p-3 bg-success text-white rounded shadow-sm">
            <h5>Faculty</h5>
            <h3>{{ $facultyCount }}</h3>
         </div>
      </div>
      <div class="col-md-4">
         <div class="p-3 bg-warning text-white rounded shadow-sm">
            <h5>Courses</h5>
            <h3>{{ $courseCount }}</h3>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 mb-4">
         <h4>Enrollments per Course</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="enrollmentChart"></canvas>
         </div>
      </div>
      <div class="col-md-6 mb-4">
         <h4>Attendance Status</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="attendanceChart"></canvas>
         </div>
      </div>
      <div class="col-md-6 mb-4">
         <h4>Grade Distribution (Students on X-axis)</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="gradeChart"></canvas>
         </div>
      </div>
      <div class="col-md-6 mb-4">
         <h4>Average Grade per Course</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="avgGradeChart"></canvas>
         </div>
      </div>
      <div class="col-md-6 mb-4">
         <h4>Submissions per Course</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="submissionChart"></canvas>
         </div>
      </div>
      <div class="col-md-6 mb-4">
         <h4>Enrollment Trend Over Time</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="enrollmentTrendChart"></canvas>
         </div>
      </div>
      <div class="col-md-12 mb-4">
         <h4>Attendance by Day</h4>
         <div class="chart-wrapper mb-4">
            <canvas id="attendanceDayChart"></canvas>
         </div>
      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   new Chart(document.getElementById('enrollmentChart'), {
       type: 'bar',
       data: {
           labels: {!! json_encode($enrollmentData->pluck('course_key')) !!},
           datasets: [{
               label: 'Enrollments',
               data: {!! json_encode($enrollmentData->pluck('total')) !!},
               backgroundColor: 'rgba(54, 162, 235, 0.7)'
           }]
       }
   });
   new Chart(document.getElementById('attendanceChart'), {
       type: 'pie',
       data: {
           labels: {!! json_encode($attendanceData->pluck('status')) !!},
           datasets: [{
               data: {!! json_encode($attendanceData->pluck('total')) !!},
               backgroundColor: ['#4bc0c0', '#ff6384', '#ffcd56']
           }]
       }
   });
   new Chart(document.getElementById('gradeChart'), {
       type: 'bar',
       data: {
           labels: {!! json_encode($gradeData->pluck('grade')) !!},
           datasets: [{
               label: 'Students',
               data: {!! json_encode($gradeData->pluck('total')) !!},
               backgroundColor: '#9966ff'
           }]
       },
       options: { indexAxis: 'y' }
   });
   new Chart(document.getElementById('avgGradeChart'), {
       type: 'bar',
       data: {
           labels: {!! json_encode($avgGrade->pluck('course_key')) !!},
           datasets: [{
               label: 'Average Grade',
               data: {!! json_encode($avgGrade->pluck('average')) !!},
               backgroundColor: '#36a2eb'
           }]
       }
   });
   new Chart(document.getElementById('submissionChart'), {
       type: 'bar',
       data: {
           labels: {!! json_encode($submissionCounts->pluck('course_key')) !!},
           datasets: [{
               label: 'Submissions',
               data: {!! json_encode($submissionCounts->pluck('total')) !!},
               backgroundColor: '#ff9f40'
           }]
       }
   });
   new Chart(document.getElementById('enrollmentTrendChart'), {
       type: 'line',
       data: {
           labels: {!! json_encode($enrollmentTrend->pluck('day')) !!},
           datasets: [{
               label: 'Enrollments',
               data: {!! json_encode($enrollmentTrend->pluck('total')) !!},
               borderColor: '#4bc0c0',
               fill: false,
               tension: 0.2
           }]
       }
   });
   new Chart(document.getElementById('attendanceDayChart'), {
       type: 'line',
       data: {
           labels: {!! json_encode($attendanceByDay->pluck('day')) !!},
           datasets: [{
               label: 'Attendance Count',
               data: {!! json_encode($attendanceByDay->pluck('total')) !!},
               borderColor: '#ff6384',
               fill: true,
               backgroundColor: 'rgba(255,99,132,0.2)'
           }]
       }
   });
</script>
@endsection