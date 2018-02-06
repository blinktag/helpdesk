<div class="nav flex-column nav-pills" id="v-pills-tab" aria-orientation="vertical">
  <a class="nav-link {{ return_if(on_page('account'), 'active') }}" id="v-pills-home-tab" href="{{ route('account.index') }}" aria-controls="v-pills-home" aria-selected="true">Account Overview</a>
  <a class="nav-link {{ return_if(on_page('account/profile'), 'active') }}" id="v-pills-profile-tab" href="{{ route('account.profile.index') }}" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link {{ return_if(on_page('account/password'), 'active') }}" id="v-pills-messages-tab" href="{{ route('account.password.index') }}" aria-controls="v-pills-messages" aria-selected="false">Change Password</a>
 </div>
