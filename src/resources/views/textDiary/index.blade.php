@extends('layouts.auth')

@section('title', label('textDiary.index'))

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#diaryCategory" data-toggle="collapse">
                                カテゴリ<span class="glyphicon glyphicon-chevron-up pull-right"></span>
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="diaryCategory">
                        <div class="list-group">
                            <a class="list-group-item active" href="#">
                                整枝
                                <span class="badge">0</span>
                            </a>
                            <a class="list-group-item" href="#">
                                交配
                                <span class="badge">6</span>
                            </a>
                            <a class="list-group-item" href="#">
                                収穫
                                <span class="badge">12</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">日記タイトル</h4>
                </div>
                <div class="panel-body">
                    <p>
                        <small>Posted: {{ date(config('format.datetime')) }} |</small>
                        <span class="label label-primary">整枝</span>
                        <span class="label label-primary">交配</span>
                    </p>

                    <p>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                    </p>

                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/bETfY4HW9YopX48-INCkXuObJjdc-ZsC5atlEnYPaKzcqLt2VX1k0DIAVQ2esD2WOGC686ZK5c12A2gyFhLFODOY1Ga-lWQZhJtdJUMaMRuCDgEbLA8Qxflz7XFEmeUaImefo_Lbv0KePfqMQAPxiffkF0BCPCdbNxC4rPp5-vu_tMq_US5O-BoEgacX1OfH2iRXACBsnV4ujklxxrapHodgl117c7wBu7d1bu3dW_fiWW37QaDpaNLtP_6Fpb-emyyxWQM1WQ0UjQ8IGl-9RWq0It7C-SsK_dlca4hWVEHGfmSJicnlodkavhbsNLBvHZ2akaE5bTl2acJM7PY-3jS8UH7x27dha5BFRKlmEljFBEayizM8SYompha8ljgAQ3rvOQAueWysigkgNCVDhjB7ZJeeYIDzGZ60rLzT0-_C9mQ6i7ZoXpG17qCRt6Nx1pKlzteXjLvQuvLC-0VhjKcjbqzBsfTptVrmA3MkHT8EJVJ2jj5H-8Waw-5ef64-4PItlJbC96-Zdhowu0fGEh4Ke1cVo6fwrDjZY_HXttg=w1698-h955-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>

                    <div class="col-md-12">
                        {!! BootForm::open() !!}

                        {!! BootForm::submit('編集', 'btn-primary') !!}

                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">日記タイトル</h4>
                </div>
                <div class="panel-body">
                    <p>
                        <small>Posted: {{ date(config('format.datetime')) }} |</small>
                        <span class="label label-primary">整枝</span>
                        <span class="label label-primary">交配</span>
                    </p>

                    <p>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                        The quick brown fox jumps over the lazy dog<br>
                    </p>

                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/KGQwvL_OquEmRJUTm50ocm-pWXPTJPrSIARObfPAP76ywFqS9b1GA5d6gUxjZl5ecu2MiCLMLkKXo4GNrx1rDZn_NbeGFUaAJYFawhzzrjzqnGE6z_7OomFGUyJUt5r3VVm7jRcAoZuY6GssMvlyuOYYTLc9XIQ1QTtrno_fkiFNFRCGZsuy8zVLFUoABE93B-GHQeD_jHyk4Cr4Wz2hgXGfMHM7I6yWJTmzPAppxd4BcKB82Hq_HcdTSSimDAJKhQGr2XXIVZlTmvYZAnVB20bM6wIeNIej3TPf_LqCJq8UCx-0IR1kKSSIsDQBKmYD5HXbdaICcH8kyMvmNZNByC4qaf_aDeVSZj4N3vr8asYU5jm8S8xi5Afs9Ju4sdJsG24gHYtm2dTykAH722xiSkfHLCHvnGmvQoL4cMLIWJDDVSJCqAc-JzQOHeLoeZr2CY1M46oLDhTn3w69wgymAJbT4PrNG85F60gJUXB-AEjEnWXkJQivFgbzQV15sY8B5KnWNpX6qBQMtAm6NYl3WCz8Pjbfg6pcVvD6oZizl7c=w538-h956-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/KGQwvL_OquEmRJUTm50ocm-pWXPTJPrSIARObfPAP76ywFqS9b1GA5d6gUxjZl5ecu2MiCLMLkKXo4GNrx1rDZn_NbeGFUaAJYFawhzzrjzqnGE6z_7OomFGUyJUt5r3VVm7jRcAoZuY6GssMvlyuOYYTLc9XIQ1QTtrno_fkiFNFRCGZsuy8zVLFUoABE93B-GHQeD_jHyk4Cr4Wz2hgXGfMHM7I6yWJTmzPAppxd4BcKB82Hq_HcdTSSimDAJKhQGr2XXIVZlTmvYZAnVB20bM6wIeNIej3TPf_LqCJq8UCx-0IR1kKSSIsDQBKmYD5HXbdaICcH8kyMvmNZNByC4qaf_aDeVSZj4N3vr8asYU5jm8S8xi5Afs9Ju4sdJsG24gHYtm2dTykAH722xiSkfHLCHvnGmvQoL4cMLIWJDDVSJCqAc-JzQOHeLoeZr2CY1M46oLDhTn3w69wgymAJbT4PrNG85F60gJUXB-AEjEnWXkJQivFgbzQV15sY8B5KnWNpX6qBQMtAm6NYl3WCz8Pjbfg6pcVvD6oZizl7c=w538-h956-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>

                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/QGjd6kKknNQbbabMJe_D4hxua-nM-ZBdoWqAtUPKqNJW4Tjncjmg54-JaJaeQX7E3Nt4vYWOvzjmNrLDkaM1kGdcudFrHTS5lmFBJ4YuwaO-aRhmAm8N0Jt0t8zkbg1WJnb-tFS3E8MlAYL_OWqFfYAhbBdbnhBaBABknuRgaJLf24CspJoFe_43mlKmvWXr3AbZ3Rbvo1l9b5Nf62E9XQN7ldUAvEHP5CeQ-BmEgQX0IuBP4kyB407eR-tZHasLrUaBxx-uWiH71Ge6oQhNjJy9jk_yjWBTkrYV-1b1xoTdi649VN1vaffisSef0gtvLEB8cgNa0_I36znJxBMAhIHTujTnBA_RUvlE-zUipRUxcbjoBaFzwnAtJSoqoNURxh02DQ00sjGWLDSTWbiC4Ys0d3x7lTQ5TZMqep1sgedasRS0TXORjydS05FjM7oak-X2M9ouB8iPK5_yT5Ldvswyff1Z_fhDuS7VDtSflW9n6opkez2Z-h83X3oojZZqRVciT2M1Tb6XkPlGpuLlmzFYWzKXdS-4kOe6D64telI=w717-h955-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/QGjd6kKknNQbbabMJe_D4hxua-nM-ZBdoWqAtUPKqNJW4Tjncjmg54-JaJaeQX7E3Nt4vYWOvzjmNrLDkaM1kGdcudFrHTS5lmFBJ4YuwaO-aRhmAm8N0Jt0t8zkbg1WJnb-tFS3E8MlAYL_OWqFfYAhbBdbnhBaBABknuRgaJLf24CspJoFe_43mlKmvWXr3AbZ3Rbvo1l9b5Nf62E9XQN7ldUAvEHP5CeQ-BmEgQX0IuBP4kyB407eR-tZHasLrUaBxx-uWiH71Ge6oQhNjJy9jk_yjWBTkrYV-1b1xoTdi649VN1vaffisSef0gtvLEB8cgNa0_I36znJxBMAhIHTujTnBA_RUvlE-zUipRUxcbjoBaFzwnAtJSoqoNURxh02DQ00sjGWLDSTWbiC4Ys0d3x7lTQ5TZMqep1sgedasRS0TXORjydS05FjM7oak-X2M9ouB8iPK5_yT5Ldvswyff1Z_fhDuS7VDtSflW9n6opkez2Z-h83X3oojZZqRVciT2M1Tb6XkPlGpuLlmzFYWzKXdS-4kOe6D64telI=w717-h955-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>

                    <div class="col-md-4">
                        <p>
                            <a href="https://lh3.googleusercontent.com/X2LESp7o6tH3Pef7IPRzwR-fdXahi6GNAiWNLMaEdTSBjGSO8-y70Bh8QmhetzmPMZU6KybT5iN76eqAOQ0WOW_6xRRRaKFJC5Fe8J0dwlylmOhjoqvWik35QEIFessJ4ty64JpGi3PitEZrAjxpS7l7KPkCd0G3hGTyXOt3R63gqNhy2MW3nU8qVbgFZn-qGTuYt-ABFPRaHe6_7_R-CGeLGgxhOEzNPW06e3EFOZhOlN5SzflIxyJWhS3vfE4WsBsYgBKp3bRRQ96KvtOp1dbjO1cQhHn5qOP3-Fg61yTB53sYYrQXQxHxOW65EgLfX-yANONvqXMM2QJH6lRUOO8Gu_JbXvvZB4vbDZJW-HfhBRjBTlTTjvKYoac297JEPYt3Ibigl7AaF_-FzvpSAVrL7bDuuqMxHZSvzw1BvfXziJmxVbkhshtG2-OJ8FJyVCBwJJcNVg0XartI_T-acQoPqG4Y6jpwNeFMLSr1WaW6QgZDtfaSfca6Q2xuMdyC4C4hSiTLDKzqUYSjy3xd__jKWOsOwdb626cTQIb_6Cg=w538-h956-no"
                               data-gallery title="日記タイトル">
                                <img src="https://lh3.googleusercontent.com/X2LESp7o6tH3Pef7IPRzwR-fdXahi6GNAiWNLMaEdTSBjGSO8-y70Bh8QmhetzmPMZU6KybT5iN76eqAOQ0WOW_6xRRRaKFJC5Fe8J0dwlylmOhjoqvWik35QEIFessJ4ty64JpGi3PitEZrAjxpS7l7KPkCd0G3hGTyXOt3R63gqNhy2MW3nU8qVbgFZn-qGTuYt-ABFPRaHe6_7_R-CGeLGgxhOEzNPW06e3EFOZhOlN5SzflIxyJWhS3vfE4WsBsYgBKp3bRRQ96KvtOp1dbjO1cQhHn5qOP3-Fg61yTB53sYYrQXQxHxOW65EgLfX-yANONvqXMM2QJH6lRUOO8Gu_JbXvvZB4vbDZJW-HfhBRjBTlTTjvKYoac297JEPYt3Ibigl7AaF_-FzvpSAVrL7bDuuqMxHZSvzw1BvfXziJmxVbkhshtG2-OJ8FJyVCBwJJcNVg0XartI_T-acQoPqG4Y6jpwNeFMLSr1WaW6QgZDtfaSfca6Q2xuMdyC4C4hSiTLDKzqUYSjy3xd__jKWOsOwdb626cTQIb_6Cg=w538-h956-no"
                                     alt="" class="img-thumbnail">
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div align="center">
                <ul class="pagination">
                    <li class="disabled"><span>«</span></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="?page=2">2</a></li>
                    <li><a href="?page=3">3</a></li>
                    <li><a href="?page=4">4</a></li>
                    <li><a href="?page=5">5</a></li>
                    <li><a href="?page=6">6</a></li>
                    <li><a href="?page=7">7</a></li>
                    <li><a href="?page=8">8</a></li>
                    <li class="disabled"><span>...</span></li>
                    <li><a href="?page=13">13</a></li>
                    <li><a href="?page=14">14</a></li>
                    <li><a href="?page=2" rel="next">»</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
