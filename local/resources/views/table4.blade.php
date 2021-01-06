@extends('layouts.template')
@section('stylesheet')
<style>
    table {
        table-layout: fixed;
    }


</style>

@stop
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    <p class="card-description"> Add class <code>.table</code> </p>
                    <table class="table" border="1">
                        <thead>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr bgcolor="#e1e1d0">
                                <td colspan="8">ข้อมูลทั่วไป</td>
                                <td colspan="2">ข้อมูลวันเวลาที่ผลิต</td>
                                <td colspan="2">ข้อมูลรหัสผ่าน</td>
                            </tr>
                            <tr>
                                <td colspan="8" style="vertical-align: top;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-1">ท.พ./ท.ญ.</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">เบอร์โทร</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">ช่างประจำ</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'ช่างประจำ']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-1">ร.พ./คลีนิค</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ร.พ./คลีนิค']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">ที่อยู่</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'ที่อยู่']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">เบอร์โทร</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">Line</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-1">ชื่อคนไข้</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ร.พ./คลีนิค']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">นามสกุล</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'ที่อยู่']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">HN</label>
                                        <div class="col-sm-1">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">อายุ</label>
                                        <div class="col-sm-1">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">เพศ</label>
                                        <div class="col-sm-1">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-1">ชื่อเซล</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">เขต</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                            </div>
                                        </div>
                                        <label class="col-form-label col-sm-1">หมายเหตุ</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                {{ Form::text('phone',null, ['class' => 'form-control','placeholder' => 'ช่างประจำ']) }}
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">วันรับงาน</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">วันส่งงาน</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">วันส่งจริง</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">รอบงาน</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td colspan="2" style="vertical-align: top;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">ใหม่</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">barcode</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">ref.code</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">ประเภทงาน</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                {{ Form::text('doctor',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr bgcolor="#e1e1d0">
                                <td colspan="3">เลือกซี่ฟัน</td>
                                <td colspan="3">ตารางสรุปซี่ฟัน</td>
                                <td colspan="2" bgcolor="#ffa366">คำสั่งพิเศษ</td>
                                <td colspan="4" bgcolor="#ffa366">สิ่งที่ส่งมาด้วย</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="vertical-align: top;">

                                </td>
                                <td colspan="3" style="vertical-align: top;">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ซี่ฟัน</th>
                                                <th>สินค้า</th>
                                                <th>กลุ่ม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#11</td>
                                                <td>ฟันปลอม</td>
                                                <td>PFM</td>
                                            </tr>
                                            <tr>
                                                <td>#12</td>
                                                <td>ฟันปลอม</td>
                                                <td>PFM</td>
                                            </tr>
                                            <tr>
                                                <td>#13</td>
                                                <td>ฟันปลอม</td>
                                                <td>PFM</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td colspan="2" style="vertical-align: top;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ดู Wax full contour</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ดู Design ทางไลน์</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ลอง contour พอสเลนก่อนเกรซ</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ส่งกลับให้คุณหมอดู</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ทำ PINDEX</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ให้ช่างโทรกลับในขั้นตอน</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">โทรกลับแล้ว</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ทางไลน์</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">คุณหมอส่งสีฟันมาทางไลน์</label>
                                    </div>
                                </td>
                                <td colspan="4" colspan="2" style="vertical-align: top;">
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">IMPRESSION</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">WORKING MODEL</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">STUDY MODEL</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ส่งกลับให้คุณหมอดู</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">BITE</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">คู่สบ</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-12">ARTICULATOR</label>
                                    </div>
                                </td>
                            </tr>
                            <tr bgcolor="#47d147">
                                <td colspan="12">for Designed</td>
                            </tr>
                            <tr bgcolor="#e1e1d0">
                                <td colspan="3">ALLOY</td>
                                <td colspan="3">SHADE</td>
                                <td colspan="3">MARGIN AND METAL DESIGN</td>
                                <td colspan="3">CONTOUR / Occlusion Design</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
