@component('mail::message')
# Thông tin liên hệ

**Tên:** {{ $contactData['name'] }}
**Email:** {{ $contactData['email'] }}
**Tiêu đề:** {{ $contactData['subject'] ?? '(Không có)' }}

**Nội dung:**
{{ $contactData['message'] }}

@endcomponent
