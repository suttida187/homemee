@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{ url('property-create') }}">
                    <button type="button" class="btn btn-primary m-3 col-3">
                        เพิ่มอสังหา
                    </button>
                </a>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่ออสังหา</th>
                                <th scope="col">ประเภททรัพย์สิน</th>
                                <th scope="col">ที่ตั้ง</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">พื้นที่</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($query as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->property_name }}</td>
                                    <td>{{ $item->property_type }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->area }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @php
                                            $img_url = json_decode(htmlspecialchars_decode($item->img));
                                        @endphp
                                        @foreach ($img_url as $url)
                                            <img src="{{ URL::asset('img/product/' . $url) }}"
                                                class="img-thumbnail d-inline-block" alt="..."
                                                style="width: 100px; height: auto;">
                                        @endforeach
                                    </td>
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
