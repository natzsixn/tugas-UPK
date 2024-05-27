@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="header-title d-flex align-items-center justify-content-between w-100">
                <h4 class="card-title">Detail Surat Masuk </h4><a href="{{ route('mail.index') }}"
                    class="btn btn-primary mt-3">Kembali</a>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-5">
            <div class="card card-block card-stretch card-height-helf">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title ">
                        <h4 class="card-title">Detail Surat Masuk</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td>Pembuat</td>
                            <td>:</td>
                            <td>{{ $mail->user['username'] }}</td>
                        </tr>
                        <tr>
                            <td>code surat</td>
                            <td>:</td>
                            <td>{{ $mail->mail_code }}</td>
                        </tr>
                        <tr>
                            <td>tanggal</td>
                            <td>:</td>
                            <td>{{ $mail->mail_date }}</td>
                        </tr>
                        <tr>
                            <td>jutuan</td>
                            <td>:</td>
                            <td>{{ $mail->mail_from }}</td>
                        </tr>
                        <tr>
                            <td>kepada</td>
                            <td>:</td>
                            <td>{{ $mail->mail_to }}</td>
                        </tr>
                        <tr>
                            <td>subjek</td>
                            <td>:</td>
                            <td>{{ $mail->mail_subject }}</td>
                        </tr>
                        <tr>
                            <td>deskripsi</td>
                            <td>:</td>
                            <td>{{ $mail->description }}</td>
                        </tr>
                        <tr>
                            <td>tipe surat</td>
                            <td>:</td>
                            <td>{{ $mail->mailType['type'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title d-flex align-items-center justify-content-between w-100">
                        <h4 class="card-title">Surat</h4>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary mx-1" id="prev">prev</button>
                            <button class="btn btn-primary mx-1" id="next">next</button>
                            <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center mt-2">
                        @if ($mail->file_upload)
                            @php
                                $extension = pathinfo($mail->file_upload, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($extension, ['pdf']))
                                {{-- Tampilkan file PDF --}}
                                <canvas id="the-canvas" class="w-100 "></canvas>
                            @elseif (in_array($extension, ['png', 'jpg', 'jpeg']))
                                {{-- Tampilkan file gambar --}}
                                <img src="{{ asset('uploads/' . $mail->file_upload) }}" alt="File" width="100%"
                                    height="600px">
                            @else
                                {{-- Tipe file tidak didukung --}}
                                <p>File tidak dapat ditampilkan. Tipe file tidak didukung.</p>
                            @endif
                        @else
                            <p>File tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            var url = "{{ asset($mail->file_upload) }}";

            // Loaded via <script> tag, create shortcut to access PDF.js exports.
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 2, // Tingkatkan skala untuk kualitas yang lebih baik
                canvas = document.getElementById('the-canvas'),
                ctx = canvas.getContext('2d');

            /**
             * Get page info from document, resize canvas accordingly, and render page.
             * @param num Page number.
             */
            function renderPage(num) {
                pageRendering = true;
                // Using promise to fetch the page
                pdfDoc.getPage(num).then(function (page) {
                    var viewport = page.getViewport({ scale: scale });
                    var outputScale = window.devicePixelRatio || 1;

                    canvas.width = Math.floor(viewport.width * outputScale);
                    canvas.height = Math.floor(viewport.height * outputScale);

                    var transform = outputScale !== 1
                        ? [outputScale, 0, 0, outputScale, 0, 0]
                        : null;

                    // Render PDF page into canvas context
                    var renderContext = {
                        canvasContext: ctx,
                        transform: transform,
                        viewport: viewport
                    };
                    var renderTask = page.render(renderContext);

                    // Wait for rendering to finish
                    renderTask.promise.then(function () {
                        pageRendering = false;
                        if (pageNumPending !== null) {
                            // New page rendering is pending
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                    });
                });

                // Update page counters
                document.getElementById('page_num').textContent = num;
            }

            /**
             * If another page rendering in progress, waits until the rendering is
             * finished. Otherwise, executes rendering immediately.
             */
            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } else {
                    renderPage(num);
                }
            }

            /**
             * Displays previous page.
             */
            function onPrevPage() {
                if (pageNum <= 1) {
                    return;
                }
                pageNum--;
                queueRenderPage(pageNum);
            }
            document.getElementById('prev').addEventListener('click', onPrevPage);

            /**
             * Displays next page.
             */
            function onNextPage() {
                if (pageNum >= pdfDoc.numPages) {
                    return;
                }
                pageNum++;
                queueRenderPage(pageNum);
            }
            document.getElementById('next').addEventListener('click', onNextPage);

            /**
             * Asynchronously downloads PDF.
             */
            pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('page_count').textContent = pdfDoc.numPages;

                // Initial/first page rendering
                renderPage(pageNum);
            });
        });
    </script>
@endsection
