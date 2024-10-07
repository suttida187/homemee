@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row agent-center">
            <div class="col-md-10">
                <a href="{{ url('agent-create') }}">
                    <button type="button" class="btn btn-primary m-3 col-3">
                        เพิ่มเอเจน
                    </button>
                </a>
                <div class="card">
                <div class="m-3"> 
                    <form id="multiStepForm" class="multi-step-form d-flex" method="POST"
                    action="{{ route('search') }}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Search" name="search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ชื่อตัวแทนขาย</th>
                                <th scope="col">นามสกุลตัวแทนขาย</th>
                                <th scope="col">หมายเลขโทรศัพท์</th>
                                <th scope="col">อีเมลของตัวแทนขาย</th>
                                <th scope="col">รายชื่ออสังหาริมทรัพย์ที่ตัวแทนรับผิดชอบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($query as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->assigned_properties }}</td>
                         
                                    <td>
                                        <a href="{{ url('property-edit',$item->id) }}"><button type="button" class="btn btn-primary">แก้ไข</button></a>
                                    </td>
                                    <td>
                                        <a href="{{ url('property-delete', $item->id) }}" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?');">
                                            <button type="button" class="btn btn-danger">ลบ</button>
                                        </a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
