@extends('layouts.default')
@section('content')
    <div class="grid">
        <h1>List of matching affiliates within 100km from Dublin office who were invited for some food and drinks</h1>
        <table>
            <tr>
                <th>Affiliate ID</th>
                <th>Name</th>
                <th>Distance</th>
            </tr>
            @forelse ($affiliates as $affiliate)
                <tr>
                    <td>{{ $affiliate->affiliate_id }}</td>
                    <td>{{ $affiliate->name }}</td>
                    <td>{{ $affiliate->distance }} km</td>
                </tr>
            @empty
                <p>No affiliates</p>
            @endforelse
        </table>
    </div>
@endsection
