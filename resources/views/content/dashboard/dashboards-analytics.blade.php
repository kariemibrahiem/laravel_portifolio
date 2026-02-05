@extends('layouts/contentNavbarLayout')

@section('title', trns("Dashboard"))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<style>
  .layout-page{
    overflow-x: hidden !important;
  }
  .layout-wrapper{
    overflow-x: hidden !important;
  }
  
  .analytics-dashboard-skin {
    background: #f8f9fa;
  }
  
  .kpi-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    padding: 24px;
    margin-bottom: 16px;
  }
  
  .kpi-card-mint {
    background: #e8f5f0;
  }
  
  .kpi-card-sky {
    background: #e0f4ff;
  }
  
  .kpi-card-cyan {
    background: #d0f4ff;
  }
  
  .kpi-card-yellow {
    background: #fff9e6;
  }
  
  .kpi-number {
    font-size: 36px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 12px 0;
  }
  
  .kpi-label {
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
  }
  
  .kpi-subtext {
    font-size: 13px;
    color: #0da574;
    font-weight: 500;
  }
  
  .kpi-icon {
    font-size: 24px;
    margin-bottom: 8px;
  }
  
  .table-project {
    font-size: 13px;
  }
  
  .progress-bar-thin {
    height: 6px;
    border-radius: 3px;
  }
  
  .status-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
  }
  
  .status-on-track {
    background: #e0f4ff;
    color: #0da574;
  }
  
  .status-delayed {
    background: #ffe0e0;
    color: #d32f2f;
  }
  
  .status-at-risk {
    background: #fff9e6;
    color: #f0ad4e;
  }
  
  .status-completed {
    background: #e8f5f0;
    color: #0da574;
  }
</style>

<div class="analytics-dashboard-skin">
<div class="row">
  <div class="col-lg-8 mb-4 order-0">
    <!-- KPI Cards Row 1 -->
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <div class="kpi-card kpi-card-mint">
          <div class="d-flex justify-content-between align-items-flex-start">
            <div>
              <div class="kpi-label">{{ trns('Total Projects') }}</div>
              <div class="kpi-number">6</div>
              <div class="kpi-subtext">2 Completed</div>
            </div>
            <div class="kpi-icon">💼</div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="kpi-card kpi-card-sky">
          <div class="d-flex justify-content-between align-items-flex-start">
            <div>
              <div class="kpi-label">{{ trns('Task') }}</div>
              <div class="kpi-number">132</div>
              <div class="kpi-subtext">28 Completed</div>
            </div>
            <div class="kpi-icon">📋</div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <div class="kpi-card kpi-card-yellow">
          <div class="d-flex justify-content-between align-items-flex-start">
            <div>
              <div class="kpi-label">{{ trns('Members') }}</div>
              <div class="kpi-number">8</div>
              <div class="kpi-subtext">2 Completed</div>
            </div>
            <div class="kpi-icon">👥</div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="kpi-card kpi-card-mint">
          <div class="d-flex justify-content-between align-items-flex-start">
            <div>
              <div class="kpi-label">{{ trns('Productivity') }}</div>
              <div class="kpi-number">76%</div>
              <div class="kpi-subtext">26% Increased</div>
            </div>
            <div class="kpi-icon">🎯</div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Active Projects Table -->
    <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
      <div class="card-body p-4">
        <h5 class="mb-4" style="font-size: 16px; font-weight: 600; color: #1a1a1a;">Active Projects</h5>
        
        <div class="table-responsive">
          <table class="table table-borderless table-project">
            <thead>
              <tr style="border-bottom: 1px solid #e0e0e0;">
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Name') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Progress') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Status') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Assigned') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Website Redesign</div>
                  <div style="font-size: 11px; color: #999;">Jan 30, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 65%; background: #00bcd4; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">65%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-on-track">On Track</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #c3e9ed;">
                    <img src="{{asset('assets/img/avatars/2.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #d4f1d4;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Marketing Campaign</div>
                  <div style="font-size: 11px; color: #999;">Feb 10, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 20%; background: #ff6b6b; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">20%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-delayed">Delayed</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/3.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #ffe0e0;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Mobile App Development</div>
                  <div style="font-size: 11px; color: #999;">Mar 1, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 45%; background: #ffc107; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">45%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-at-risk">At Risk</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/4.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #fff9e6;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Customer Portal Upgrade</div>
                  <div style="font-size: 11px; color: #999;">Feb 15, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 89%; background: #00bcd4; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">89%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-on-track">On Track</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/5.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #d4f1d4;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr>
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Product Launch</div>
                  <div style="font-size: 11px; color: #999;">Jan 29, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 100%; background: #4caf50; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">100%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-completed">Completed</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/6.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #e8f5f0;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div style="text-align: center; padding: 16px 0;">
          <a href="#" style="color: #00bcd4; text-decoration: none; font-weight: 500; font-size: 13px;">View All Projects</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 order-1">
    <!-- Task Progress Card -->
    <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
      <div class="card-body p-4">
        <h5 style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 24px;">{{ trns('Task Progress') }}</h5>
        
        <div style="text-align: center; margin-bottom: 24px;">
          <div style="font-size: 48px; font-weight: 700; color: #1a1a1a;">64%</div>
        </div>
        
        <div style="margin-bottom: 20px;">
          <div style="display: flex; gap: 4px; height: 6px; border-radius: 3px; overflow: hidden;">
            <div style="flex: 24%; background: #00bcd4;"></div>
            <div style="flex: 35%; background: #4caf50;"></div>
            <div style="flex: 41%; background: #ff9800;"></div>
          </div>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid #f0f0f0;">
          <div style="text-align: center; flex: 1;">
            <div style="font-size: 12px; color: #999; margin-bottom: 4px;">24%</div>
          </div>
          <div style="text-align: center; flex: 1;">
            <div style="font-size: 12px; color: #999; margin-bottom: 4px;">35%</div>
          </div>
          <div style="text-align: center; flex: 1;">
            <div style="font-size: 12px; color: #999; margin-bottom: 4px;">41%</div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Stat Cards Row -->
    <div class="row g-3 mb-4">
      <div class="col-4">
        <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); text-align: center; padding: 20px;">
          <div style="width: 48px; height: 48px; border-radius: 50%; background: #e8f5f0; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
            <i class="bx bx-check-circle" style="color: #0da574; font-size: 24px;"></i>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px;">8</div>
          <div style="font-size: 11px; color: #999;">Completed</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); text-align: center; padding: 20px;">
          <div style="width: 48px; height: 48px; border-radius: 50%; background: #e0f4ff; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
            <i class="bx bx-loader-circle" style="color: #00bcd4; font-size: 24px;"></i>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px;">12</div>
          <div style="font-size: 11px; color: #999;">In-Progress</div>
        </div>
      </div>
      <div class="col-4">
        <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); text-align: center; padding: 20px;">
          <div style="width: 48px; height: 48px; border-radius: 50%; background: #ffe0e0; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
            <i class="bx bx-error-circle" style="color: #d32f2f; font-size: 24px;"></i>
          </div>
          <div style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px;">14</div>
          <div style="font-size: 11px; color: #999;">Up Coming</div>
        </div>
      </div>
    </div>
    
    <!-- AI Assistant Card -->
    <div class="card mb-4" style="border: none; border-radius: 12px; background: linear-gradient(135deg, #0da574 0%, #00bcd4 100%); color: white; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12); padding: 24px; text-align: center;">
      <div style="font-size: 48px; margin-bottom: 16px;">🤖</div>
      <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: white;">{{ trns('How AI assist will') }}<br>{{ trns('help you') }}?</h5>
      <button class="btn" style="background: white; color: #0da574; font-weight: 600; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px;">{{ trns('Start AI') }}</button>
    </div>
    
    <!-- Project Budget Card -->
    <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
      <div class="card-body p-4">
        <div style="font-size: 12px; color: #999; text-transform: uppercase; margin-bottom: 8px;">{{ trns('Project Budget') }}</div>
        <div style="font-size: 12px; color: #666; margin-bottom: 16px;">Budget Allocation Overview:</div>
        <div style="font-size: 32px; font-weight: 700; color: #1a1a1a;">$50,000</div>
      </div>
    </div>
  </div>
{{-- 
  <!-- Total Revenue -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-3">{{ trns("Total Revenue") }}</h5>
          <div id="totalRevenueChart" class="px-2"></div>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-center">
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  2022
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                  <a class="dropdown-item" href="javascript:void(0);">2021</a>
                  <a class="dropdown-item" href="javascript:void(0);">2020</a>
                  <a class="dropdown-item" href="javascript:void(0);">2019</a>
                </div>
              </div>
            </div>
          </div>
          <div id="growthChart"></div>
          <div class="text-center fw-medium pt-3 mb-2">62% {{ trns("Company Growth") }}</div>

          <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>2022</small>
                <h6 class="mb-0">$32.5k</h6>
              </div>
            </div>
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>2021</small>
                <h6 class="mb-0">$41.2k</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <!--/ Total Revenue -->
  <div class="col-12 w-100 order-3 order-md-2">
    <div class="row w-100">
  <!-- Teachers -->
  <div class="col-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <i class="bx bx-chalkboard" style="font-size: 1.75rem;"></i>
          </div>
          <div class="dropdown-menu-end" >
              {{-- <a class="dropdown-item" href="{{route('teachers.index')}}">{{ trns("View More") }}</a> --}}
            </div>
        </div>
        <span>{{ trns("teachers") }}</span>
        {{-- <h3 class="card-title text-nowrap mb-1">{{$teachersCount}}</h3> --}}
      </div>
    </div>
  </div>

  <!-- Families -->
  <div class="col-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <i class="bx bx-user" style="font-size: 1.75rem;"></i>
          </div>
          <div class=" dropdown-menu-end">
              {{-- <a class="dropdown-item" href="{{route('familys.index')}}">{{ trns("View More") }}</a> --}}
            </div>
        </div>
        <span>{{ trns("families") }}</span>
        {{-- <h3 class="card-title text-nowrap mb-1">{{$familiesCount}}</h3> --}}
      </div>
    </div>
  </div>

  <!-- Payments -->
  <div class="col-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="Payments" class="rounded">
          </div>
          <div class=" dropdown-menu-end">
              {{-- <a class="dropdown-item" href="{{route('orders.index')}}">{{ trns("View More") }}</a> --}}
            </div>
        </div>
        <span class="d-block mb-1">{{ trns("Payments") }}</span>
        {{-- <h3 class="card-title text-nowrap mb-2">{{ $paymentsCount }}</h3> --}}
      </div>
    </div>
  </div>

  <!-- Transactions -->
  <div class="col-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Transactions" class="rounded">
          </div>
          <div class=" dropdown-menu-end">
              {{-- <a class="dropdown-item" href="{{route('transactions.index')}}">{{ trns("View More") }}</a> --}}
            </div>
        </div>
        <span class="fw-semibold d-block mb-1">{{ trns("Transactions") }}</span>
        {{-- <h3 class="card-title mb-2">{{ $transactionsCount }}</h3> --}}
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
</div>
<div class="row" @if(app()->getLocale() == 'ar') style="margin-top: 25rem;" @endif>
  <!-- Order Statistics -->
<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
  <div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
      <div class="card-title mb-0">
        <h5 class="m-0 me-2">{{ trns("Order Statistics") }}</h5>
        {{-- <small class="text-muted">{{ $ordersCount }} {{ trns("Total Sales") }}</small> --}}
      </div>
    </div>
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column align-items-center gap-1">
          {{-- <h2 class="mb-2">{{ $ordersCompletedCount }}</h2> --}}
          <span>{{ trns("Total Orders completed") }}</span>
        </div>
        <canvas id="ordersChart" style="max-width: 150px; max-height: 150px;"></canvas>

      </div>

      <ul class="p-0 m-0">
        <!-- Pending -->
        <li class="d-flex mb-4 pb-1">
          <div class="avatar flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-primary">
              <i class='bx bx-time-five'></i>

            </span>
          </div>
          <div class="d-flex w-100 align-items-center justify-content-between flex-nowrap gap-2">
            <div class="me-2 flex-grow-1 text-truncate">
              <h6 class="mb-0">{{ trns("pending") }}</h6>
              <small class="text-muted">{{ trns("orders waiting for payment") }}</small>
            </div>
            <div class="user-progress flex-shrink-0">
              {{-- <small class="fw-medium">{{ $ordersPendingCount }}</small> --}}
            </div>
          </div>
        </li>

        <!-- Refunded -->
        <li class="d-flex mb-4 pb-1">
          <div class="avatar flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-success">
              <i class='bx bx-undo'></i>

            </span>
          </div>
          <div class="d-flex w-100 align-items-center justify-content-between flex-nowrap gap-2">
            <div class="me-2 flex-grow-1 text-truncate">
              <h6 class="mb-0">{{ trns("refunded") }}</h6>
              <small class="text-muted">{{ trns("orders that have been refunded") }}</small>
            </div>
            <div class="user-progress flex-shrink-0">
              {{-- <small class="fw-medium">{{ $ordersRefundedCount }}</small> --}}
            </div>
          </div>
        </li>

        <!-- Cancelled -->
        <li class="d-flex mb-4 pb-1">
          <div class="avatar flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-info"><i class='bx bx-x-circle'></i>
</span>
          </div>
          <div class="d-flex w-100 align-items-center justify-content-between flex-nowrap gap-2">
            <div class="me-2 flex-grow-1 text-truncate">
              <h6 class="mb-0">{{ trns("cancelled") }}</h6>
              <small class="text-muted">{{ trns("orders that have been cancelled") }}</small>
            </div>
            <div class="user-progress flex-shrink-0">
              {{-- <small class="fw-medium">{{ $ordersCancelledCount }}</small> --}}
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--/ Order Statistics -->

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('ordersChart').getContext('2d');

    const data = {
        labels: ['Pending', 'Completed', 'Refunded', 'Cancelled'],
        datasets: [{
            data: [
                {{ $ordersPendingCount }},
                {{ $ordersCompletedCount }},
                {{ $ordersRefundedCount }},
                {{ $ordersCancelledCount }}
            ],
            backgroundColor: [
                '#ffc107', // Pending - warning
                '#28a745', // Completed - success
                '#17a2b8', // Refunded - info
                '#6c757d'  // Cancelled - secondary
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, padding: 10 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw + ' orders';
                        }
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
});
</script> --}}


<!-- Expense Overview -->

<!--/ Expense Overview -->



  <!-- Transactions -->
  <!-- Transactions -->
<div class="col-md-6 col-lg-4 order-2 mb-4">
  <div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="card-title m-0 me-2">{{ trns("orders") }}</h5>
      
    </div>

    <div class="card-body">
      <!-- Single icon at the top -->
      <div class="d-flex p-4 pt-3">
        <div class="avatar flex-shrink-0 me-3">
          <img src="{{ asset('assets/img/icons/unicons/cc-success.png') }}" alt="Transactions" class="rounded">
        </div>
        <div>
          <small class="text-muted d-block">{{ trns('Last 5 Orders') }}</small>
        </div>
      </div>

      <ul class="list-unstyled mb-0">
         {{-- @foreach($orders5 as $order)
              @php
                  $status = $order->status->value ?? 'N/A';
              @endphp
              <li class="d-flex align-items-center justify-content-between py-2 border-bottom">
                <div>
                  <h6 class="mb-0">{{ $order->student?->name ?? trns('Unknown') }}</h6>
                  <small class="text-muted">#{{ $order->transaction_id ?? trns('N/A') }}</small>
                </div>

                <div class="text-end">
                  <h6 class="mb-0">${{ number_format($order->amount, 2) }}</h6>
                  <small class="badge 
                      @if($status == 'pending') bg-warning 
                      @elseif($status == 'success') bg-success 
                      @elseif($status == 'cancelled') bg-danger 
                      @elseif($status == 'refunded') bg-info 
                      @else bg-secondary @endif">
                      {{ ucfirst($status) }}
                  </small>
                </div>
              </li>
            @endforeach --}}
      </ul>
    </div>
  </div>
</div>




  <!-- Transactions -->
  <!-- Transactions -->
<div class="col-md-6 col-lg-4 order-2 mb-4">
  <div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="card-title m-0 me-2">{{ trns("Transactions") }}</h5>
      
    </div>

    <div class="card-body">
      <!-- Single icon at the top -->
      <div class="d-flex p-4 pt-3">
        <div class="avatar flex-shrink-0 me-3">
          <img src="{{ asset('assets/img/icons/unicons/cc-success.png') }}" alt="Transactions" class="rounded">
        </div>
        <div>
          <small class="text-muted d-block">{{ trns('Last 5 Transactions') }}</small>
        </div>
      </div>

      <ul class="list-unstyled mb-0">
        {{-- @foreach($transaction as $tran)
          <li class="d-flex align-items-center justify-content-between py-2 border-bottom">
            <div>
              <h6 class="mb-0">{{ $tran->teacher?->name ?? trns('Teacher') }}</h6>
              <small class="text-muted">{{ trns("Transaction ID:") }} {{ $tran->id }}</small>
            </div>
            <div class="text-end">
              <h6 class="mb-0">${{ number_format($tran->total, 2) }}</h6>
              <span class="text-muted">USD</span>
            </div>
          </li>
        @endforeach --}}
      </ul>
    </div>
  </div>
</div>


  <!--/ Transactions -->
</div>
@endsection
