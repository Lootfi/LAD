@extends('adminlte::page')

@section('title', 'Course')

@section('content_header')
<li class="breadcrumb-item">Course</li>
@endsection

@section('content')

<div class="container-fluid mt--7">

    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <livewire:teacher.course.cards.graphs.students-activity />
        </div>
        <div class="col-xl-4">
            <livewire:teacher.course.cards.students-online />
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Lesson visits</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Page name</th>
                                <th scope="col">Visits</th>
                                <th scope="col">Unique users</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    Lesson 01
                                </th>
                                <td>
                                    459
                                </td>
                                <td>
                                    2
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Social traffic</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Referral</th>
                                <th scope="col">Visitors</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    Facebook
                                </th>
                                <td>
                                    1,480
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">60%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Facebook
                                </th>
                                <td>
                                    5,480
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">70%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar"
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 70%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Google
                                </th>
                                <td>
                                    4,807
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">80%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 80%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    Instagram
                                </th>
                                <td>
                                    3,678
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">75%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-info" role="progressbar"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 75%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    twitter
                                </th>
                                <td>
                                    2,645
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">30%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 30%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection


@section('js')
<script>
    console.log(window.Echo);
</script>

@endsection