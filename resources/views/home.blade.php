@extends('adminlte::page')

@section('title', 'Dashboard - NK informatique')

@section('content_header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $leadCount }}</h3>
                        <p>Leads</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('contact.leads') }}" class="small-box-footer">Liste des leads <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $prospectCount }}</h3>
                        <p>Prospects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <a href="{{ route('contact.prospects') }}" class="small-box-footer">Liste des prospects <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $clientCount }}</h3>
                        <p>Clients</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <a href="{{ route('contact.clients') }}" class="small-box-footer">Liste des clients <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ number_format($conversionRate, 2) }}%</h3>
                        <p>Taux de conversion clients</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer"><i class="fas"></i></a>
                </div>
            </div>
            <div class="graphs d-flex justify-content-center">
                <div class="card card-primary card-outline chart-card">
                    <div class="card-header">
                        <h3 class="card-title">Répartition des contacts</h3>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 475px;" width="950" height="500" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
                <div class="card card-primary card-outline chart-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Nombre de clients par mois (en <span id="currentYear">2023</span>)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;">
                            <canvas id="barChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline chart-card todo">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            To Do List
                        </h3>
                        <div class="card-tools">
                            {{ $actions->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                            @foreach($actions as $action)
                            <li class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="text-item">{{ substr($action->contact->first_name . ' ' . $action->contact->last_name . ' | ' . $action->type . ' - ' . $action->comment, 0, 50) }}@if(strlen($action->contact->first_name . ' ' . $action->contact->last_name . ' | ' . $action->type . ' - ' . $action->comment) > 50)...@endif</span>
                                </div>
                                @php
                                $now = \Carbon\Carbon::now();
                                $scheduledAt = $action->scheduled_at ? \Carbon\Carbon::parse($action->scheduled_at) : null;
                                $remainingTime = $scheduledAt ? $now->diffInHours($scheduledAt, false) : null;
                                @endphp
                                <div class="d-flex align-items-center">
                                    <small class="badge ml-2 mr-2
                                            @if($remainingTime !== null)
                                                @if ($remainingTime < 0)
                                                    badge-danger
                                                @elseif ($remainingTime <= 30)
                                                    badge-warning
                                                @elseif ($remainingTime <= 72)
                                                    badge-yellow
                                                @else
                                                    badge-success
                                                @endif
                                            @endif">
                                        <i class="far fa-clock"></i>
                                        @if($action->scheduled_at)
                                        {{ \Carbon\Carbon::parse($action->scheduled_at)->diffForHumans() }}
                                        @else
                                        Pas de date prévue
                                        @endif
                                    </small>
                                    <div class="d-inline-block tools">
                                        <a href="{{ route('actions.edit', $action) }}" class="fas fa-edit mr-1"></a>
                                        <form action="{{ route('actions.destroy', $action) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fas fa-trash-o" style="border:none;background:none;"></button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-footer clearfix">
                        <a href="{{ route('actions.index') }}" class="small-box-footer">Voir les actions <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="timeline timeline-card">
                <div class="time-label">
                    <span class="bg-green">30 mars 2023</span>
                </div>
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                        <h3 class="timeline-header"><a href="#">Lucas</a> vous a répondu</h3>
                        <div class="timeline-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                        </div>
                    </div>
                </div>
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 10:34</span>
                        <h3 class="timeline-header"><a href="#">Nicolas</a> vous a répondu</h3>
                        <div class="timeline-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..
                        </div>
                    </div>
                </div>
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 09:23</span>
                        <h3 class="timeline-header"><a href="#">Alain</a> vous a répondu</h3>
                        <div class="timeline-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline timeline-card">
                <div class="time-label">
                    <span class="bg-green">28 mars 2023</span>
                </div>
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 07:54</span>
                        <h3 class="timeline-header"><a href="#">Lucas</a> vous a répondu</h3>
                        <div class="timeline-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline timeline-card">
                <div class="time-label">
                    <span class="bg-green">25 mars 2023</span>
                </div>
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 16:32</span>
                        <h3 class="timeline-header"><a href="#">Lucie</a> vous a répondu</h3>
                        <div class="timeline-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .chart-card {
        margin-left: 10px;
    }

    .timeline-card {
        margin-top: 20px;
    }

    .graphs {
        margin-top: 30px;
    }


    .graphs .chart-card {
        flex-grow: 1;
        max-width: 100%;
    }

</style>
<script>
var donutData = {
    datasets: [{
        data: [{{$leadCount}}, {{$prospectCount}}, {{$clientCount}}],
        backgroundColor: ['#17A2B8', '#DC3545', '#FFC107'],
    }],

    labels: [
        'Leads',
        'Prospects',
        'Clients'
    ]
};

var donutOptions = {
    maintainAspectRatio : false,
    responsive : true,
};

var donutChart = new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: donutData,
    options: donutOptions      
});

// Récupération des données clients par mois
var clientData = [];
$.ajax({
    url: "{{ route('clients-by-month') }}",
    method: "GET",
    success: function(data) {
        var clientData = [];
        var leadData = [];
        var prospectData = [];

        for (let i = 0; i < 12; i++) {
            var clientMonthData = data.clients.find(item => parseInt(item.month) === (i + 1));
            var leadMonthData = data.leads.find(item => parseInt(item.month) === (i + 1));
            var prospectMonthData = data.prospects.find(item => parseInt(item.month) === (i + 1));

            clientData.push(clientMonthData ? clientMonthData.count : 0);
            leadData.push(leadMonthData ? leadMonthData.count : 0);
            prospectData.push(prospectMonthData ? prospectMonthData.count : 0);
        }

        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                {
                    label: 'Leads',
                    data: leadData,
                    backgroundColor: 'rgba(23, 162, 184, 1)',
                    borderColor: 'rgba(15, 105, 119, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Prospects',
                    data: prospectData,
                    backgroundColor: 'rgba(220, 53, 69, 1)',
                    borderColor: 'rgba(155, 38, 50, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Clients',
                    data: clientData,
                    backgroundColor: 'rgba(255, 193, 7, 1)',
                    borderColor: 'rgba(226, 171, 6, 1)',
                    borderWidth: 2
                }
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    }
});
document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>

@stop