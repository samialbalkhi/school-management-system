<?php

namespace App\Providers;


use App\Repository\ExamRepository;
use App\Repository\FeesRepository;
use App\Repository\QuizzRepository;
use App\Repository\ReceiptRepository;
use App\Repository\SubjectRepository;
use App\Repository\QuestionRepository;
use App\Repository\StudentsRepository;
use App\Repository\TeachersRepository;
use App\Repository\GraduatedRepository;
use App\Repository\promotionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\AttendanceRepository;
use App\Repository\FeesinvoicesRepository;
use App\Repository\ExamRepositoryInterface;
use App\Repository\FeesRepositoryInterface;
use App\Repository\PaymentStudentRepository;
use App\Repository\QuizzRepositoryInterface;
use App\Repository\StudentPremiumRepository;
use App\Repository\ReceiptRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\StudentsRepositoryInterface;
use App\Repository\TeachersRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use App\Repository\GraduatedRepositoryInterface;
use App\Repository\promotionRepositoryInterface;
use App\Repository\AttendanceRepositoryInterface;
use App\Repository\FeesinvoicesRepositoryInterface;
use App\Repository\PaymentStudentRepositoryInterface;
use App\Repository\StudentPremiumRepositoryInterface;


class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    

            $this->app->bind(TeachersRepositoryInterface::class,TeachersRepository::class);
            $this->app->bind(StudentsRepositoryInterface::class,StudentsRepository::class);
            $this->app->bind(promotionRepositoryInterface::class,promotionRepository::class);
            $this->app->bind(GraduatedRepositoryInterface::class,GraduatedRepository::class);
            $this->app->bind(FeesRepositoryInterface::class,FeesRepository::class);
            $this->app->bind(FeesinvoicesRepositoryInterface::class,FeesinvoicesRepository::class);
            $this->app->bind(ReceiptRepositoryInterface::class,ReceiptRepository::class);
            $this->app->bind(PaymentStudentRepositoryInterface::class,PaymentStudentRepository::class);
            $this->app->bind(StudentPremiumRepositoryInterface::class,StudentPremiumRepository::class);
            $this->app->bind(AttendanceRepositoryInterface::class,AttendanceRepository::class);
            $this->app->bind(SubjectRepositoryInterface::class,SubjectRepository::class);
            $this->app->bind(QuizzRepositoryInterface::class,QuizzRepository::class);
            $this->app->bind(QuestionRepositoryInterface::class,QuestionRepository::class);








    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
