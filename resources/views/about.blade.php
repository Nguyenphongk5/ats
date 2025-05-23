@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <div class="relative bg-gradient-to-r from-indigo-700 to-blue-500 text-white py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Tập đoàn Công nghệ CMC</h1>
            <p class="text-xl md:text-2xl font-light">Kiến tạo tương lai số - Vươn tầm thế giới</p>
        </div>
    </div>

    <!-- Nội dung chính -->
    <div class="bg-white py-16 px-6">
        <div class="max-w-5xl mx-auto space-y-14">

            <!-- Giới thiệu chung -->
            <section>
                <h2 class="text-3xl font-bold text-blue-800 mb-4">Giới thiệu chung</h2>
                <p class="text-gray-700 leading-relaxed text-lg">
                    Thành lập từ năm 1993, Tập đoàn Công nghệ CMC là một trong những tập đoàn công nghệ hàng đầu tại Việt Nam. Với hơn 30 năm xây dựng và phát triển, CMC hoạt động trong nhiều lĩnh vực then chốt như:
                    <strong>giải pháp phần mềm, tích hợp hệ thống, viễn thông, dịch vụ hạ tầng số, an ninh mạng và chuyển đổi số.</strong>
                    <br><br>
                    Tập đoàn hiện sở hữu nhiều công ty thành viên và liên doanh trong nước và quốc tế, cùng đội ngũ hơn 4.000 nhân viên có chuyên môn cao. CMC hướng đến trở thành một trong những tập đoàn công nghệ số hàng đầu khu vực và thế giới.
                </p>
            </section>

            <!-- Sứ mệnh -->
            <section>
                <h2 class="text-2xl font-semibold text-indigo-700 mb-2">Sứ mệnh</h2>
                <p class="text-gray-700 text-lg">
                    Kết nối tri thức - Khơi nguồn sáng tạo - Lan tỏa thành công.<br>
                    CMC cam kết kiến tạo hệ sinh thái số toàn diện nhằm giúp doanh nghiệp, tổ chức và chính phủ tăng cường năng lực số hóa, góp phần thúc đẩy phát triển kinh tế - xã hội bền vững.
                </p>
            </section>

            <!-- Tầm nhìn -->
            <section>
                <h2 class="text-2xl font-semibold text-indigo-700 mb-2">Tầm nhìn</h2>
                <p class="text-gray-700 text-lg">
                    Trở thành tập đoàn công nghệ toàn cầu, dẫn đầu về giải pháp chuyển đổi số, cung cấp dịch vụ và sản phẩm sáng tạo, chất lượng, đáng tin cậy, đáp ứng yêu cầu ngày càng cao của khách hàng trong và ngoài nước.
                </p>
            </section>

            <!-- Giá trị cốt lõi -->
            <section>
                <h2 class="text-2xl font-semibold text-indigo-700 mb-2">Giá trị cốt lõi</h2>
                <ul class="list-disc list-inside text-gray-700 text-lg space-y-2">
                    <li><strong>Khách hàng là trung tâm:</strong> Tất cả hoạt động đều nhằm mang lại giá trị tốt nhất cho khách hàng.</li>
                    <li><strong>Đổi mới không ngừng:</strong> Liên tục cải tiến để tạo ra các sản phẩm và dịch vụ tiên tiến.</li>
                    <li><strong>Chất lượng – Uy tín:</strong> Cam kết chất lượng cao và thực hiện đúng lời hứa.</li>
                    <li><strong>Hợp tác và phát triển:</strong> Đề cao sự đoàn kết, tôn trọng và hỗ trợ lẫn nhau trong công việc.</li>
                </ul>
            </section>

            <!-- Lịch sử phát triển -->
            <section>
                <h2 class="text-2xl font-semibold text-indigo-700 mb-2">Lịch sử phát triển</h2>
                <p class="text-gray-700 text-lg">
                    Trong suốt hơn 30 năm hoạt động, CMC đã ghi dấu ấn với nhiều bước ngoặt quan trọng:
                </p>
                <ul class="list-disc list-inside text-gray-700 text-lg mt-4 space-y-1">
                    <li><strong>1993:</strong> Thành lập Công ty TNHH HT&TM CMC.</li>
                    <li><strong>2007:</strong> Chuyển đổi thành Tập đoàn Công nghệ CMC.</li>
                    <li><strong>2018:</strong> Thành lập khối CMC Global – Đẩy mạnh xuất khẩu phần mềm.</li>
                    <li><strong>2020:</strong> Ra mắt nền tảng hạ tầng điện toán đám mây CMC Cloud.</li>
                    <li><strong>2023:</strong> Định vị chiến lược "CMC 4.0" – tập trung vào chuyển đổi số toàn diện.</li>
                </ul>
            </section>

            <!-- Hình ảnh minh họa (tùy chọn) -->
            <section class="text-center mt-12">
                <img src="https://cmc.com.vn/Data/Sites/1/media/cmcholding/ve-cmc/tap-doan-cmc.jpg"
                     alt="Tập đoàn CMC" class="rounded-lg shadow-lg mx-auto w-full max-w-3xl">
                <p class="text-sm text-gray-500 mt-2">Tập đoàn Công nghệ CMC - Khát vọng vươn xa</p>
            </section>
        </div>
    </div>
@endsection
