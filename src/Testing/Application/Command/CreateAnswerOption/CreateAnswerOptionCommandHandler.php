<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateAnswerOption;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Testing\Domain\Factory\AnswerOptionFactory;
use App\Testing\Domain\Repository\QuestionRepositoryInterface;
use Webmozart\Assert\Assert;

class CreateAnswerOptionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly AnswerOptionFactory $answerOptionFactory,
        private readonly QuestionRepositoryInterface $questionRepository,
    ) {
    }

    public function __invoke(CreateAnswerOptionCommand $command): string
    {
        $question = $this->questionRepository->findOneById($command->questionId);
        Assert::notEmpty($question, 'Тест не найден');
        $answerOption = $this->answerOptionFactory->create($question, $command->description, $command->correct);
        $question->addAnswerOption($answerOption);
        $this->questionRepository->add($question);

        return $answerOption->getId();
    }
}
